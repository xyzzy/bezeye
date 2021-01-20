SHELL = bash

ACLOCAL_AMFLAGS = -I m4
EXTRA_DIST = \
	LICENSE.txt CHANGELOG.md README.md \
	.gitignore .nojekyll \
	Build.txt \
	Compare.md \
	cmp-840x472-*.png \
	gen-bezeye.sh \
	mootools-core-1.4.5.js \
	mootools-more-1.4.0.1.js \
	original-7.pal \
	palette-*.pal \
	render.php \
	storyboard.html \
	wing.php \
	wing-outline.png

bin_PROGRAMS = diffgif mergeraw scq6

diffgif_SOURCES = diffgif.cc
diffgif_LDADD = -lgd

mergeraw_SOURCES = mergeraw.cc
mergeraw_LDADD = -lgd

scq6_SOURCES = scq6.cc
scq6_LDADD = -lgd

# Build wing texture data
wing.gif :
	mkdir -p wingdata
	php $(srcdir)/wing.php $(srcdir)/wing-outline.png wingdata/%02d.png
	ffmpeg -i wingdata/%02d.png $@ -y

# Create true-colour frames for animation (hardcoded 1280x720)
frames-840x472.gif : frames-1280x720.gif
	mkdir -p frames-840x472
	ffmpeg -i frames-1280x720.gif -vf scale=840:472 $@ -y </dev/null
frames-1280x720.gif : wing.gif
	mkdir -p frames-1280x720
	php $(srcdir)/render.php wingdata/%02d.png frames-1280x720/%03d.png
	ffmpeg -r 20 -i frames-1280x720/%03d.png $@ -y

# create palette for resolution and filter size
.PRECIOUS: palette-%-3x3.pal palette-%-5x5.pal # keep files when intermediate
palette-%-3x3.pal : scq6 frames-1280x720.gif
	./scq6 --palette=octree --thresh=1024 --seed=1396282354 --filter=3 --ifilter=1 --initial-temperature=1.000000 --final-temperature=0.001000 --temperature-per-level=3 --repeat-per-temperature=1 frames-1280x720/000.png - $* /dev/null -v -v --genpalette >$@
palette-%-5x5.pal : scq6 frames-1280x720.gif
	./scq6 --palette=octree --thresh=1024 --seed=1396282354 --filter=5 --ifilter=1 --initial-temperature=1.000000 --final-temperature=0.001000 --temperature-per-level=3 --repeat-per-temperature=1 frames-1280x720/000.png - $* /dev/null -v -v --genpalette >$@

# Colour compress frames
.PRECIOUS: bezeye-840x472-%-3x3.gif bezeye-840x472-%-5x5.gif bezeye-1280x720-%-3x3.gif bezeye-1280x720-%-5x5.gif # keep files when intermediate
bezeye-840x472-%-3x3.gif : diffgif mergeraw frames-840x472.gif palette-%-3x3.pal
	NUMCOL=$* FILTER=3 PALETTE=palette-$*-3x3.pal OUTDIR=bezeye-840x472-$*-3x3 $(srcdir)/gen-bezeye.sh
	./mergeraw $@  bezeye-840x472-$*-3x3/img-000.gif bezeye-840x472-$*-3x3/diff-???.gif --delay=5 -f
bezeye-840x472-%-5x5.gif : diffgif mergeraw frames-840x472.gif palette-%-5x5.pal
	NUMCOL=$* FILTER=5 PALETTE=palette-$*-5x5.pal OUTDIR=bezeye-840x472-$*-5x5 $(srcdir)/gen-bezeye.sh
	./mergeraw $@  bezeye-840x472-$*-5x5/img-000.gif bezeye-840x472-$*-5x5/diff-???.gif --delay=5 -f
bezeye-1280x720-%-3x3.gif : diffgif mergeraw frames-1280x720.gif palette-%-3x3.pal
	NUMCOL=$* FILTER=3 PALETTE=palette-$*-3x3.pal OUTDIR=bezeye-1280x720-$*-3x3 $(srcdir)/gen-bezeye.sh
	./mergeraw $@  bezeye-1280x720-$*-3x3/img-000.gif bezeye-1280x720-$*-3x3/diff-???.gif --delay=5 -f
bezeye-1280x720-%-5x5.gif : diffgif mergeraw frames-1280x720.gif palette-%-5x5.pal
	NUMCOL=$* FILTER=5 PALETTE=palette-$*-5x5.pal OUTDIR=bezeye-1280x720-$*-5x5 $(srcdir)/gen-bezeye.sh
	./mergeraw $@  bezeye-1280x720-$*-5x5/img-000.gif bezeye-1280x720-$*-5x5/diff-???.gif --delay=5 -f

# create side-by-side comparisons
.PRECIOUS: sbs-840x472-%-3x3.gif sbs-840x472-%-5x5.gif sbs-1280x720-%-3x3.gif sbs-1280x720-%-5x5.gif # keep files when intermediate
sbs-840x472-%-3x3.gif : frames-840x472.gif bezeye-840x472-%-3x3.gif
	ffmpeg -loglevel warning -i frames-840x472.gif -i bezeye-840x472-$*-3x3.gif  -filter_complex "[1:v][0:v]blend=all_expr=if(gt(X\,Y*(W/H))\,A\,B)" $@ -y </dev/null
sbs-840x472-%-5x5.gif : frames-840x472.gif bezeye-840x472-%-5x5.gif
	ffmpeg -loglevel warning -i frames-840x472.gif -i bezeye-840x472-$*-5x5.gif  -filter_complex "[1:v][0:v]blend=all_expr=if(gt(X\,Y*(W/H))\,A\,B)" $@ -y </dev/null
sbs-1280x720-%-3x3.gif : frames-1280x720.gif bezeye-1280x720-%-3x3.gif
	ffmpeg -loglevel warning -i frames-1280x720.gif -i bezeye-1280x720-$*-3x3.gif  -filter_complex "[1:v][0:v]blend=all_expr=if(gt(X\,Y*(W/H))\,A\,B)" $@ -y </dev/null
sbs-1280x720-%-5x5.gif : frames-1280x720.gif bezeye-1280x720-%-5x5.gif
	ffmpeg -loglevel warning -i frames-1280x720.gif -i bezeye-1280x720-$*-5x5.gif  -filter_complex "[1:v][0:v]blend=all_expr=if(gt(X\,Y*(W/H))\,A\,B)" $@ -y </dev/null

# all animated gifs
all-gif-840x472-3x3 : bezeye-840x472-4-3x3.gif bezeye-840x472-5-3x3.gif bezeye-840x472-6-3x3.gif bezeye-840x472-7-3x3.gif bezeye-840x472-8-3x3.gif bezeye-840x472-9-3x3.gif bezeye-840x472-10-3x3.gif \
	bezeye-840x472-11-3x3.gif bezeye-840x472-12-3x3.gif bezeye-840x472-13-3x3.gif bezeye-840x472-14-3x3.gif bezeye-840x472-15-3x3.gif bezeye-840x472-16-3x3.gif \
	bezeye-840x472-32-3x3.gif bezeye-840x472-64-3x3.gif
all-gif-840x472-5x5 : bezeye-840x472-4-5x5.gif bezeye-840x472-5-5x5.gif bezeye-840x472-6-5x5.gif bezeye-840x472-7-5x5.gif bezeye-840x472-8-5x5.gif bezeye-840x472-9-5x5.gif bezeye-840x472-10-5x5.gif \
	bezeye-840x472-11-5x5.gif bezeye-840x472-12-5x5.gif bezeye-840x472-13-5x5.gif bezeye-840x472-14-5x5.gif bezeye-840x472-15-5x5.gif bezeye-840x472-16-5x5.gif \
	bezeye-840x472-32-5x5.gif bezeye-840x472-64-5x5.gif
all-gif-1280x720-3x3 : bezeye-1280x720-4-3x3.gif bezeye-1280x720-5-3x3.gif bezeye-1280x720-6-3x3.gif bezeye-1280x720-7-3x3.gif bezeye-1280x720-8-3x3.gif bezeye-1280x720-9-3x3.gif bezeye-1280x720-10-3x3.gif \
	bezeye-1280x720-11-3x3.gif bezeye-1280x720-12-3x3.gif bezeye-1280x720-13-3x3.gif bezeye-1280x720-14-3x3.gif bezeye-1280x720-15-3x3.gif bezeye-1280x720-16-3x3.gif \
	bezeye-1280x720-32-3x3.gif bezeye-1280x720-64-3x3.gif
all-gif-1280x720-5x5 : bezeye-1280x720-4-5x5.gif bezeye-1280x720-5-5x5.gif bezeye-1280x720-6-5x5.gif bezeye-1280x720-7-5x5.gif bezeye-1280x720-8-5x5.gif bezeye-1280x720-9-5x5.gif bezeye-1280x720-10-5x5.gif \
	bezeye-1280x720-11-5x5.gif bezeye-1280x720-12-5x5.gif bezeye-1280x720-13-5x5.gif bezeye-1280x720-14-5x5.gif bezeye-1280x720-15-5x5.gif bezeye-1280x720-16-5x5.gif \
	bezeye-1280x720-32-5x5.gif bezeye-1280x720-64-5x5.gif

# all animated gifs
all-sbs-840x472-3x3 : sbs-840x472-4-3x3.gif sbs-840x472-5-3x3.gif sbs-840x472-6-3x3.gif sbs-840x472-7-3x3.gif sbs-840x472-8-3x3.gif sbs-840x472-9-3x3.gif sbs-840x472-10-3x3.gif \
	sbs-840x472-11-3x3.gif sbs-840x472-12-3x3.gif sbs-840x472-13-3x3.gif sbs-840x472-14-3x3.gif sbs-840x472-15-3x3.gif sbs-840x472-16-3x3.gif \
	sbs-840x472-32-3x3.gif sbs-840x472-64-3x3.gif
all-sbs-840x472-5x5 : sbs-840x472-4-5x5.gif sbs-840x472-5-5x5.gif sbs-840x472-6-5x5.gif sbs-840x472-7-5x5.gif sbs-840x472-8-5x5.gif sbs-840x472-9-5x5.gif sbs-840x472-10-5x5.gif \
	sbs-840x472-11-5x5.gif sbs-840x472-12-5x5.gif sbs-840x472-13-5x5.gif sbs-840x472-14-5x5.gif sbs-840x472-15-5x5.gif sbs-840x472-16-5x5.gif
all-sbs-1280x720-3x3 : sbs-1280x720-4-3x3.gif sbs-1280x720-5-3x3.gif sbs-1280x720-6-3x3.gif sbs-1280x720-7-3x3.gif sbs-1280x720-8-3x3.gif sbs-1280x720-9-3x3.gif sbs-1280x720-10-3x3.gif \
	sbs-1280x720-11-3x3.gif sbs-1280x720-12-3x3.gif sbs-1280x720-13-3x3.gif sbs-1280x720-14-3x3.gif sbs-1280x720-15-3x3.gif sbs-1280x720-16-3x3.gif \
	sbs-1280x720-32-3x3.gif sbs-1280x720-64-3x3.gif
all-sbs-1280x720-5x5 : sbs-1280x720-4-5x5.gif sbs-1280x720-5-5x5.gif sbs-1280x720-6-5x5.gif sbs-1280x720-7-5x5.gif sbs-1280x720-8-5x5.gif sbs-1280x720-9-5x5.gif sbs-1280x720-10-5x5.gif \
	sbs-1280x720-11-5x5.gif sbs-1280x720-12-5x5.gif sbs-1280x720-13-5x5.gif sbs-1280x720-14-5x5.gif sbs-1280x720-15-5x5.gif sbs-1280x720-16-5x5.gif
