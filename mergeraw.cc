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

#include <math.h>
#include <stdio.h>
#include <time.h>
#include <getopt.h>
#include <unistd.h>
#include <stdlib.h>
#include <stdarg.h>
#include <string.h>
#include <ctype.h>
#include <gd.h>
#include <assert.h>
#include <sys/times.h>
#include <sys/stat.h>

void usage(const char *argv0, int verbose)
{
	printf("Usage: %s [options] <output image> <source image> ...\n", argv0);
	if (verbose)
		return;

	printf("\nsource image is PNG/GIF/JPG\noutput image is GIF\n");
	
	printf("\n\
options:\n\
	-l, --loop=n	loop count\n\
	-d, --delay=n	frame delay (unit= 1/100th of a second)\n\
	-f, --force	force writing of output\n\
	-v, --verbose	show progress\n\
\n");
}

int opt_verbose		= 0;
int opt_loop		= -1;
int opt_delay		= 15;
int opt_force		= 0;

int opt_numinput 	= 0;
char *opt_output;
char *opt_input[500];

int main(int argc, char* argv[]) {

	for (;;) {
		int option_index = 0;
		enum {	LO_HELP=1, LO_VERBOSE='v', LO_LOOP='l', LO_DELAY='d', LO_FORCE='f' };
		static struct option long_options[] = {
			/* name, has_arg, flag, val */
			{"help", 0, 0, LO_HELP},
			{"verbose", 0, 0, LO_VERBOSE},
			{"loop", 1, 0, LO_LOOP},
			{"delay", 1, 0, LO_DELAY},
			{"force", 0, 0, LO_FORCE},
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
	while (optind < argc && opt_numinput < 500)
		opt_input[opt_numinput++] = argv[optind++];

	if (opt_numinput >= 500) {
		fprintf(stderr, "Too many input images\n");
		return -1;
	}

	struct stat sbuf;
	if (!opt_force && stat(opt_output, &sbuf) == 0) {
		fprintf(stderr, "Output already exists, use -f to overwrite\n");
		return -1;
	}

	int initialBpp = 3;
	int maxWidth = 0;
	int maxHeight = 0;
	for (int nr=0; nr<opt_numinput; nr++) {
		
		gdImagePtr im;
		FILE *fil = fopen(opt_input[nr], "rb");
		if (fil == NULL) {
			fprintf(stderr, "Could not open \"%s\"\n", opt_input[nr]);
			return -1;
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
			fprintf(stderr, "Could not load \"%s\"\n", opt_input[nr]);
			return -1;
		}
		fclose(fil);

		// scan for colours
		int width = gdImageSX(im);
		int height = gdImageSY(im);
		if (width > maxWidth) maxWidth = width;
		if (height > maxHeight) maxHeight = height;
		if (gdImageColorsTotal(im) >= 128) initialBpp = 8; else
		if (gdImageColorsTotal(im) >= 64) initialBpp = 7; else
		if (gdImageColorsTotal(im) >= 32) initialBpp = 6; else
		if (gdImageColorsTotal(im) >= 16) initialBpp = 5; else
		if (gdImageColorsTotal(im) >= 8) initialBpp = 4;
	}

//////////////////

	// allocate image with initial colour map
	gdImagePtr outim = gdImageCreate(maxWidth, maxHeight);

	gdImageColorAllocate(outim, 0, 0, 0);

	int* img = (int*)malloc(maxWidth*maxHeight*sizeof(int));
	for (int i=0; i<maxWidth*maxHeight; i++)
		img[i] = 0;

///////////////////
///////////////////

	FILE *ofil = fopen(opt_output, "wb");

	static unsigned char gifdata[655360];
	int		giflen = 0;
	static int	hash[4096*256];
	static int	hashver = 0;

	for (int i=0; i<65536; i++) gifdata[i] = 0;
	for (int i=0; i<4096*256; i++) hash[i] = 0;

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
	putW(maxWidth);
	putW(maxHeight);

initialBpp=8;

	// global color map | color resolution | Bits per Pixel
	putB(0<<7 | (initialBpp-1)<<4|(initialBpp-1));
	// Write out the Background color
	putB(0);
	// Byte of 0's (future expansion)
	putB(0);

	// Write out the Global Color Map
if(0)
	for (int i=0; i<(1<<initialBpp); ++i) {
		putB(gdImageRed(outim, i));
		putB(gdImageGreen(outim, i));
		putB(gdImageBlue(outim, i));
        }

	// Write Application Extension Block
	putB(0x21); putB(0xFF);
	putB(11); // 11 bytes
	putB(0x4E); putB(0x45); putB(0x54); putB(0x53); putB(0x43); putB(0x41); putB(0x50); putB(0x45); 
	putB(0x32); putB(0x2E); putB(0x30); 
	putB(3); // 3 bytes
	putB(1); // sub-block index
	putW(opt_loop);
	putB(0); // end of block

	// comment extension
	if (0) {
		char comment[128] = "Created by http://www.QRbananas.com";
		int len = strlen(comment);
		while (len%3 != 1) {
			comment[len++] = ' ';
			comment[len] = 0;
		}
		putB(0x21); putB(0xFE); putB(len);
		for (int i=0; i<len; i++)
			putB(comment[i]);
		putB(0);
	}

	fwrite(gifdata, 1, giflen, ofil);
	giflen = 0;

	for (int nr=0; nr<opt_numinput; nr++) {

		gdImagePtr im;
		FILE *fil = fopen(opt_input[nr], "rb");
		if (fil == NULL) {
			fprintf(stderr, "Could not open \"%s\"\n", opt_input[nr]);
			return -1;
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
			fprintf(stderr, "Could not load \"%s\"\n", opt_input[nr]);
			return -1;
		}
		fclose(fil);

		int width = gdImageSX(im);
		int height = gdImageSY(im);
		int palette_size = gdImageColorsTotal(im);
		if (palette_size == 0) {
			fprintf(stderr,"\"%s\" not indexed\n", opt_input[nr]);
			return -1;
		}

		for (int y = 0; y < height; y++) {
			for (int x = 0; x < width; x++) {
				img[y*maxWidth+x] = gdImagePalettePixel(im, x, y);
			}
		}
	
		// write graphics control extension
		putB(0x21); putB(0xf9);
		putB(0x04); // 4 bytes of data
		// reserved.3 | disposal.3 | userinput.1 | transparent.1
		// disposal 0=none, 1=leave, 2=restore to background, 3=restore to previous
if (nr == 0) {
		putB( 1<<2 | 0<<1 | 0<<0); // dispose=leave, user=none, transparent=given
} else {
		putB( 1<<2 | 0<<1 | 1<<0); // dispose=leave, user=none, transparent=given
}

		putW(opt_delay); // frame delay
if (nr == 0) {
		putB(0); // transparant color
} else {
		putB(im->transparent); // transparant color
}
		putB(0x00); // end of block

		// Write an Image separator
		putB(44);
		// Write the Image header
		putW(0); // left
		putW(0); // top
		putW(width);
		putW(height);

int lbpp ;
if (palette_size >= 128) lbpp=8; else
if (palette_size >= 64) lbpp=7; else
if (palette_size >= 32) lbpp=6; else
if (palette_size >= 16) lbpp=5; else
if (palette_size >= 8) lbpp=4; else
if (palette_size >= 4) lbpp=3; else
lbpp=2; 

		// Write out whether or not the image is interlaced
		putB(1<<7 | 0<<6 | 0<<5 | (lbpp-1)); // localcolor=yes, interlace=no, sort=no, size LCT=3bits


		// Write out the Local Color Map
		for (int i=0; i<(1<<lbpp); ++i) {
			putB(gdImageRed(im, i));
			putB(gdImageGreen(im, i));
			putB(gdImageBlue(im, i));
	        }

		// Write out the initial code size
		putB(initialBpp);

		int	bpp = initialBpp;
		int	CLRcode = 1 << bpp;
		int	EOFcode = CLRcode + 1;
		int	curcode = CLRcode + 2; // current code
		int	codesiz = bpp + 1; // code size on bits
		int	maxcode = (1 << codesiz) - 1; // code when its size increases

		int mark = giflen+255;
		gifdata[giflen++] = 254;

		// place CLR in head of compressed stream
		int str = CLRcode;
		curcode--; // compensate for lack of previous symbol
		hashver++;
		word = wbits = 0;

	        for (int j=0; j<height; j++)
	        for (int i=0; i<width; i++) {
			int c = img[j*maxWidth+i];

			// LZ encode
			int fcode = (c << 12) | str;
			int v = hash[fcode];
			if ( (v>>12) == hashver) {
				str = v&4095;
			} else {
				putBits(str);
				str = c;

				if (curcode < 4096) {
					hash[fcode] = curcode | hashver<<12;
					if (curcode++ > maxcode)
						maxcode = (1 << ++codesiz) - 1;
				} else {
					// CLEAR
					putBits(CLRcode);

					// reset codes
					codesiz = bpp + 1;
					maxcode = (1 << codesiz) - 1;
					curcode = CLRcode + 2;
					hashver++;
				}
			}
		}

		// last code + EOF
		putBits(str);
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

		gdImageDestroy(im);
	}

	// Write the GIF file terminator
	putB(59);

	fwrite(gifdata, 1, giflen, ofil);
	giflen = 0;

	fclose(ofil);

	return 0;
}
