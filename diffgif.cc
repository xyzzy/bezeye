/*
 * This file is part of bezeye, Evoke 2014 demoscene party entry
 * Copyright (C) 2014, xyzzy@rockingship.net
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

#include <stdio.h>
#include <stdlib.h>
#include <stdint.h>
#include <stdarg.h>
#include <ctype.h>
#include <assert.h>
#include <sys/stat.h>
#include <gd.h>
#include <getopt.h>
#include <math.h>

#define HMAX  0x00100007 // 1048583
#define HMASK 0x000fffff

struct Pixel
{
	Pixel()
	{
		r = g = b = 0;
	}

	Pixel(int r, int g, int b)
	{
		this->r = r;
		this->g = g;
		this->b = b;
	}

	Pixel(const Pixel& rhs)
	{
		r = rhs.r;
		g = rhs.g;
		b = rhs.b;
	}

	Pixel& operator=(const Pixel rhs)
	{
		r = rhs.r;
		g = rhs.g;
		b = rhs.b;
		return *this;
	}

	int r,g,b;
};
Pixel *bgimg;

struct Hrec {
	uint32_t ver;
	uint32_t val;
	uint32_t nxt;
	int code;
};
int Hversion = 0;
struct Hrec *hashDB;


void usage(const char *argv0, int verbose)
{
	printf("Usage: %s [options] <output image> <source image> [<background image>]\n", argv0);
	if (verbose)
		return;

	printf("\nsource image is PNG/GIF/JPG\noutput image is GIF\n");
	
	printf("\n\
options:\n\
	-l, --loop=n		loop count\n\
	-d, --delay=n		frame delay (unit= 1/100th of a second)\n\
	-f, --force		force writing of output\n\
	-t, --threshold=n	transparancy threshold (3*delta^2)\n\
	-v, --verbose		show progress\n\
\n");
}

int opt_verbose		= 0;
int opt_loop		= -1;
int opt_delay		= 15;
int opt_force		= 0;
int opt_threshold	= 0;
int opt_oldcode = 0;

char *opt_output;
char *opt_input;
char *opt_background;
char *opt_opaque;
char *opt_palette;

Pixel palette[1024];
int palette_size;

int howLong(const int *img, int ipos, int ilen, int *_nxt)
{
	uint32_t nxt = 0x80000000;
	uint32_t ix = 0;
	int len = 0;
	for (; ipos<ilen; ipos++) {

		uint32_t val = img[ipos];
		uint32_t bump = ((val+1)*(val+12345)) & HMASK;
		if (bump == 0) bump = 1;

			uint32_t start=ix;
			for (;;) {
				ix += bump;
				if (ix >= HMAX)
					ix -= HMAX;
				if (ix == start) {
					fprintf(stderr,"[isUnique() overflow]\n");
					assert(0);
				}

				struct Hrec *h = hashDB + ix;
				if (h->ver != Hversion) {

					if (_nxt) *_nxt = nxt;
					return len;

				} else if (h->val == val && h->nxt == nxt) {
					nxt = ix;
					len++;

					// got it, try to probe deeper
					break;
				}
			}
	}
	if (_nxt) *_nxt = nxt;
	return len;
}

int testLength(uint32_t nxt, const int* ibuf, int ipos, int ilen, uint32_t val, int tColour)
{

	uint32_t bump = ((val+1)*(val+12345)) & HMASK;
	if (bump == 0) bump = 1;

	uint32_t start=val, ix=val;
	for (;;) {
		ix += bump;
		if (ix >= HMAX)
			ix -= HMAX;
		if (ix == start) {
			fprintf(stderr,"[isUnique() overflow]\n");
			assert(0);
		}

		const struct Hrec *h = hashDB + ix;
		if (h->ver != Hversion)
			return 0; // not present

		if (h->val == val && h->nxt == nxt) {
			// found
			nxt = ix;
			break;
		}
	}

	// load next byte
	ipos++;
	if (ipos == ilen)
		return 1; // end of input. Return found byte

	val = ibuf[ipos];
	if ((val&0x8000) == 0)
		return testLength(nxt, ibuf, ipos, ilen, val, tColour)+1; // scan further

	int len1 = testLength(nxt, ibuf, ipos, ilen, tColour, tColour)+1; // scan further
	int len2 = testLength(nxt, ibuf, ipos, ilen, val&0x7fff, tColour)+1; // scan further

	return len1>len2 ? len1 : len2;
}

int main(int argc, char* argv[])
{
	hashDB = new Hrec[HMAX];

	for (;;) {
		int option_index = 0;
		enum {	LO_HELP=1, LO_VERBOSE='v', LO_LOOP='l', LO_DELAY='d', LO_FORCE='f', LO_THRESHOLD='t', LO_OLD='o', LO_OPAQUE, LO_PALETTE };
		static struct option long_options[] = {
			/* name, has_arg, flag, val */
			{"palette", 1, 0, LO_PALETTE},
			{"opaque", 1, 0, LO_OPAQUE},
			{"help", 0, 0, LO_HELP},
			{"old", 0, 0, LO_OLD},
			{"verbose", 0, 0, LO_VERBOSE},
			{"loop", 1, 0, LO_LOOP},
			{"delay", 1, 0, LO_DELAY},
			{"force", 0, 0, LO_FORCE},
			{"threshold", 1, 0, LO_THRESHOLD},
			{NULL, 0, 0, 0}
		};

		char optstring[128], *cp;
		cp = optstring;
		for (int i=0; long_options[i].name; i++) {
			if (isalpha(long_options[i].val)) {
				*cp++ = long_options[i].val;
				if (long_options[i].has_arg)
					*cp++ = ':';
			}
		}
		*cp++ = '\0';

		int c = getopt_long (argc, argv, optstring, long_options, &option_index);
		if (c == -1)
			break;

		switch (c) {
		case LO_PALETTE:
			opt_palette = optarg;
			break;
		case LO_OPAQUE:
			opt_opaque = optarg;
			break;
		case LO_OLD:
			opt_oldcode = 1;
			break;
		case LO_THRESHOLD:
			opt_threshold = strtol(optarg, NULL, 10);
			break;
		case LO_LOOP:
			opt_loop = strtol(optarg, NULL, 10);
			break;
		case LO_DELAY:
			opt_delay = strtol(optarg, NULL, 10);
			break;
		case LO_FORCE:
			opt_force++;
			break;
		case LO_VERBOSE:
			opt_verbose++;
			break;
		case LO_HELP:
			usage(argv[0], 0);
			exit(0);
			break;
		case '?':
			fprintf(stderr,"Try `%s --help' for more information.\n", argv[0]);
			exit(1);
			break;
		default:
			fprintf (stderr, "getopt returned character code %d\n", c);
			exit(1);
		}
	 }

	if (argc-optind < 2) {
		usage(argv[0], 1);
		exit(1);
	}

	opt_output = argv[optind++];
	opt_input = argv[optind++];
	opt_background = (optind < argc) ? argv[optind++] : NULL;

	struct stat sbuf;
	if (!opt_force && stat(opt_output, &sbuf) == 0) {
		fprintf(stderr, "Output already exists, use -f to overwrite\n");
		return -1;
	}

	if (opt_palette) {
fprintf(stderr,"*** --palette will remap colors and might not do what is expected\n");
		int k = 0;
		FILE* in = fopen(opt_palette, "r");
		if (in == NULL) {
			fprintf(stderr, "Could not open palette file\n");
			return -1;
		}
		double r,g,b;
		while (fscanf(in, "%lf %lf %lf\n", &r,  &g, &b) == 3) {
			if (r > 1) r /= 255.0;
			if (g > 1) g /= 255.0;
			if (b > 1) b /= 255.0;
			if (k+1 < 1024)
				palette[k++] = Pixel(r,g,b);
		}
		fclose(in);

		if (!palette_size)
			palette_size = k;
	}

//-----------------------

	gdImagePtr im;
	FILE *fil;
	int width, height;

	/*
	** Open/load background
	*/
	if (opt_background) {
		fil = fopen(opt_background, "rb");
		if (fil == NULL) {
			fprintf(stderr, "Could not open \"%s\"\n", opt_background);
			return 1;
		}
		unsigned char c[2];
		if (fread(c, 2, 1, fil) == 1) {
			rewind(fil);
			if (c[0]==0x89 && c[1]==0x50)
				im = gdImageCreateFromPng(fil);
			if (c[0]==0x47 && c[1]==0x49)
				im = gdImageCreateFromGif(fil);
			if (c[0]==0xff && c[1]==0xd8)
				im = gdImageCreateFromJpeg(fil);
		}
		if (im == NULL) {
			fprintf(stderr, "Could not load \"%s\"\n", opt_background);
			return 1;
		}
		fclose(fil);

		// get key values
		width = gdImageSX(im);
		height = gdImageSY(im);

		// allocate
		bgimg = (Pixel*)malloc(width*height*sizeof(bgimg[0]));
		assert(bgimg != NULL);

		// load map
		for (int y = 0; y < height; y++) {
			for (int x = 0; x < width; x++) {
				int v = gdImageGetTrueColorPixel(im, x, y);
	
				bgimg[y*width+x].r = (v>>16) & 0xFF;
				bgimg[y*width+x].g = (v>>8) & 0xFF;
				bgimg[y*width+x].b = v & 0xFF;
			}
		}
	}

	/*
	** Open/load input
	*/
	fil = fopen(opt_input, "rb");
	if (fil == NULL) {
		fprintf(stderr, "Could not open \"%s\"\n", opt_input);
		return 1;
	}
	unsigned char c[2];
	if (fread(c, 2, 1, fil) == 1) {
		rewind(fil);
		if (c[0]==0x89 && c[1]==0x50)
			im = gdImageCreateFromPng(fil);
		if (c[0]==0x47 && c[1]==0x49)
			im = gdImageCreateFromGif(fil);
		if (c[0]==0xff && c[1]==0xd8)
			im = gdImageCreateFromJpeg(fil);
	}
	if (im == NULL) {
		fprintf(stderr, "Could not load \"%s\"\n", opt_input);
		return 1;
	}
	fclose(fil);

	if (opt_background && (width != gdImageSX(im) || height != gdImageSY(im))) {
		fprintf(stderr,"backgroung not same size. %dx%d %dx%d\n", width,height, gdImageSX(im), gdImageSY(im));
		return 1;
	}

	// get key values
	width = gdImageSX(im);
	height = gdImageSY(im);
	int numColours = gdImageColorsTotal(im);
	if (numColours == 0) {
		fprintf(stderr,"\"%s\" not palette based\n", opt_input);
		return 1;
	}

	// allocate
	int* img = (int*)malloc(width*height*sizeof(int));
	assert(img != NULL);

	// load map
	for (int y = 0; y < height; y++) {
		for (int x = 0; x < width; x++) {
			int v = gdImagePalettePixel(im, x, y);
			if (v == gdImageGetTransparent(im))
				v = numColours; // numColours will be incremented later
			img[y*width+x] = v;
		}
	}

	/*
	** Determine sharp transparancy
	*/
	if (opt_background) {

		// reserve transparant colour
		numColours++;

		/*
		** flag transparency
		*/
		for(int y=0; y<height; y++) {
			for (int x=0; x<width; x++) {
				int v = gdImagePalettePixel(im, x, y);
				int r1 = gdImageRed(im, v);
				int g1 = gdImageGreen(im, v);
				int b1 = gdImageBlue(im, v);
				int r2 = bgimg[y*width+x].r;
				int g2 = bgimg[y*width+x].g;
				int b2 = bgimg[y*width+x].b;

				int d = (r1-r2)*(r1-r2)+(g1-g2)*(g1-g2)+(b1-b2)*(b1-b2);
				if (d < opt_threshold && img[y*width+x] != numColours-1) {
					// flag transparency
					img[y*width+x] |= 0x8000;
				}
			}
		}

		/*
		** debug output
		*/
		fil = fopen("temp2.gif", "wb");
		if (fil == NULL) {
			fprintf(stderr, "Could not open output file\n");
			return -1;
		}

		gdImagePtr outim = gdImageCreate(width, height);
		int bl = gdImageColorAllocate(outim, 0,0,0);
		int wh = gdImageColorAllocate(outim, 255,255,255);

		for(int y=0; y<height; y++) {
			for (int x=0; x<width; x++) {

				if (img[y*width+x]&0x8000) {
					gdImageSetPixel(outim, x, y, bl);
				} else {
					gdImageSetPixel(outim, x, y, wh);
				}
			}
		}

		gdImageGif(outim, fil);
		gdImageDestroy(outim);
		fclose(fil);
	}

	int	bpp = 1;
	if (numColours > 128) bpp = 8; else
	if (numColours > 64) bpp = 7; else
	if (numColours > 32) bpp = 6; else
	if (numColours > 16) bpp = 5; else
	if (numColours > 8) bpp = 4; else
	if (numColours > 4) bpp = 3; else
	if (numColours > 2) bpp = 2;

	/*
	** Setup admin
	*/
	int	ilen = width*height;
	int	ipos = 0;

	int	CLRcode = 1 << bpp;
	int	EOFcode = CLRcode + 1;
	int	curcode = CLRcode + 2; // current code
	int	codesiz = bpp + 1; // code size on bits
	int	maxcode = (1 << codesiz) - 1; // code when its size increases

	/*
	** Open output and generate header
	*/

	FILE *ofil = fopen(opt_output, "wb");

	static unsigned char gifdata[655360];
	int		giflen = 0;

	for (int i=0; i<65536; i++) gifdata[i] = 0;
	int	word = 0; // current 24 bit word. 24 bits because of later base64 encoding
	int	wbits = 0; // token offset in word

#define putB(v) gifdata[giflen++] = v;
#define putW(v) { putB(v&255); putB(v>>8); }
#define putBits(v) { \
	word |= (v) << wbits; \
	wbits += codesiz; \
	while (wbits >= 8) { \
		gifdata[giflen++] = word; \
		wbits -= 8; \
		word >>= 8; \
		if (giflen >= mark) { \
			mark = giflen+255; \
			gifdata[giflen++] = 254; \
		} \
	} \
}

	giflen = 0;

	// Write the Magic header
	putB(71); putB(73); putB(70); putB(56); putB(57); putB(97);
	// Write out the screen width and height
	putW(width);
	putW(height);

	// global color map | color resolution | Bits per Pixel
	putB(1<<7 | (8-1)<<4|(bpp-1));
	// Write out the Background color
	if (opt_background) {
		putB(numColours-1); // background==transparent
	} else {
		putB(0);
	}
	// Byte of 0's (future expansion)
	putB(0);

	// Write out the Global Color Map
	for (int i=0; i<(1<<bpp); ++i) {
		if (i >= numColours-1) {
			// hardcoded Evoke color
			putB(gdImageRed(im, 226));
			putB(gdImageRed(im, 136));
			putB(gdImageRed(im, 114));
		} else if (opt_palette) {
			putB((unsigned char)round(255*palette[i].r));
			putB((unsigned char)round(255*palette[i].g));
			putB((unsigned char)round(255*palette[i].b));
		} else {
			putB(gdImageRed(im, i));
			putB(gdImageGreen(im, i));
			putB(gdImageBlue(im, i));
		}
        }

#if 0
	// Write Application Extension Block
	putB(0x21); putB(0xFF);
	putB(11); // 11 bytes
	putB(0x4E); putB(0x45); putB(0x54); putB(0x53); putB(0x43); putB(0x41); putB(0x50); putB(0x45); 
	putB(0x32); putB(0x2E); putB(0x30); 
	putB(3); // 3 bytes
	putB(1); // sub-block index
	putW(opt_loop);
	putB(0); // end of block
#endif

	fwrite(gifdata, 1, giflen, ofil);
	giflen = 0;

#if 1
		// write graphics control extension
		putB(0x21); putB(0xf9);
		putB(0x04); // 4 bytes of data
		// reserved.3 | disposal.3 | userinput.1 | transparent.1
		// disposal 0=none, 1=leave, 2=restore to background, 3=restore to previous
		if (opt_background) {
			putB( 1<<2 | 0<<1 | 1<<0); // dispose=leave, user=none, transparent=yes
		} else {
			putB( 1<<2 | 0<<1 | 0<<0); // dispose=leave, user=none, transparent=no
		}

		putW(0); // frame delay
		if (opt_background) {
			putB(numColours-1); // transparant color
		} else {
			putB(0); // transparant color
		}
		putB(0x00); // end of block
#endif

		// Write an Image separator
		putB(44);
		// Write the Image header
		putW(0); // left
		putW(0); // top
		putW(width);
		putW(height);

		// Write out whether or not the image is interlaced
		putB(0<<7 | 0<<6 | 0<<5 | 0); // localcolor=no, interlace=no, sort=no, size LCT in bits

		// Write out the initial code size
		putB(bpp);

		/*
		** Encode
		*/

		int mark = giflen+255;
		gifdata[giflen++] = 254;
		word = wbits = 0;

//--------
		putBits(CLRcode);

		Hversion++;
		for (int i=0; i<CLRcode; i++) {
			uint32_t val = i;
			uint32_t bump = ((val+1)*(val+12345)) & HMASK;
			if (bump == 0) bump = 1;

			struct Hrec *h = hashDB + val + bump;
			h->ver = Hversion;
			h->val = val;
			h->nxt = 0x80000000;
			h->code = val;
		}

		for (ipos=0; ipos<ilen; ipos++) {

			uint32_t nxt = 0x80000000;
			int ppos = 0;

			for (ppos=0;; ppos++) {
				/*
				** what is the next byte
				*/
				uint32_t val = img[ipos+ppos];
				if (opt_oldcode) {
					val = (val&0x8000) ? numColours-1 : val;
					img[ipos+ppos] = val;
				} else if (val&0x8000) {
					int len1 = testLength(nxt, img, ipos+ppos, ilen, numColours-1, numColours-1); // probe transparent
					int len2 = testLength(nxt, img, ipos+ppos, ilen, val&0x7fff  , numColours-1); // probe opaque
					val = (len1>=len2) ? numColours-1 : img[ipos+ppos]&0x7fff;
					img[ipos+ppos] = val;
				}

				uint32_t bump = ((val+1)*(val+12345)) & HMASK;
				if (bump == 0) bump = 1;

				uint32_t start=val, ix=val;
				for (;;) {
					ix += bump;
					if (ix >= HMAX)
						ix -= HMAX;
					if (ix == start) {
						fprintf(stderr,"[isUnique() overflow]\n");
						assert(0);
					}

					struct Hrec *h = hashDB + ix;
					if (h->ver != Hversion) {
						putBits(hashDB[nxt].code);

						h->ver = Hversion;
						h->val = val;
						h->nxt = nxt;
						h->code = curcode;
						nxt = ix;

						// new LSW code, 
						goto gotseq;
					} else if (h->val == val && h->nxt == nxt) {
						nxt = ix;

						// probe further
						goto nextppos;
					}

				}
nextppos:;
			}
gotseq:

			ipos += ppos-1;

			if (curcode < 4096) {
				if (curcode++ > maxcode)
					maxcode = (1 << ++codesiz) - 1;
			} else {
				// CLEAR
				putBits(CLRcode);

				// reset codes
				codesiz = bpp + 1;
				maxcode = (1 << codesiz) - 1;
				curcode = CLRcode + 2;

				// initialize hashtable
				Hversion++;
				for (int i=0; i<CLRcode; i++) {
					uint32_t val = i;
					uint32_t bump = ((val+1)*(val+12345)) & HMASK;
					if (bump == 0) bump = 1;

					struct Hrec *h = hashDB + val + bump;
					h->ver = Hversion;
					h->val = val;
					h->nxt = 0x80000000;
					h->code = val;
				}
			}
		}

		// final code
		putBits(EOFcode);
		
		// eject current word
		while (wbits > 0) {
			gifdata[giflen++] = word;
			wbits -= 8;
			word >>= 8;
			if (giflen >= mark) {
				mark = giflen+255;
				gifdata[giflen++] = 254;
			}
		}

		// finalize last block
		if ((giflen-(mark-255))-1 <= 0) {
			// remove empty block
			giflen--;
		} else {
			// apply correct block length
			gifdata[mark-255] = (giflen-(mark-255))-1;
		}
			
		fwrite(gifdata, 1, giflen, ofil);
		giflen = 0;

		// Write out a Zero-length packet (to end the series)
		putB(0);

//----------

	// Write the GIF file terminator
	putB(59);

	fwrite(gifdata, 1, giflen, ofil);
	giflen = 0;

	fclose(ofil);

	if (opt_opaque) {
		fil = fopen(opt_opaque, "wb");
		if (fil == NULL) {
			fprintf(stderr, "Could not open output file\n");
			return -1;
		}
		gdImagePtr outim = gdImageCreate(width, height);

		// pre-allocate palette
		for(int i=0; i<numColours; i++)
			gdImageColorAllocate(outim, gdImageRed(im, i), gdImageGreen(im, i), gdImageBlue(im, i));

		for(int y=0; y<height; y++) {
			for (int x=0; x<width; x++) {
				int i = img[y*width+x];
				int r,g,b;

				if (i == numColours-1) {
					r = bgimg[y*width+x].r;
					g = bgimg[y*width+x].g;
					b = bgimg[y*width+x].b;
				} else {
					r = gdImageRed(im, i);
					g = gdImageGreen(im, i);
					b = gdImageBlue(im, i);
				}

				int found = 0;
				for (int j=0; j<gdImageColorsTotal(outim); j++) {
					if (gdImageRed(outim, j) == r && gdImageGreen(outim, j) == g && gdImageBlue(outim, j) == b) {
						gdImageSetPixel(outim, x, y, j);
						found++;
						break;
					}
				}
				if (!found)
					gdImageSetPixel(outim, x, y, gdImageColorAllocate(outim, r, g, b));
			}
		}
		gdImageGif(outim, fil);
		gdImageDestroy(outim);
		fclose(fil);
	}

	return 0;
}
