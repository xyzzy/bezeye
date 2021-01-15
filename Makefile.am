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
