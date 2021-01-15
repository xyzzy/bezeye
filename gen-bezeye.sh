#!/bin/bash

# Number of colours
[ -z "$NUMCOL" ] && NUMCOL=7
# Palette file
[ -z "$PALETTE" ] && PALETTE=palette-$NUMCOL.pal
# Source (truecolour) directory
[ -z "$SRCDIR" ] && SRCDIR=frames-1280x720
# Output directory
[ -z "$OUTDIR" ] && OUTDIR=bezeye-1280x720-$NUMCOL

SCQOPTS="--palette=$PALETTE --thresh=1024 --seed=1396282354 --filter=5 --ifilter=1 --initial-temperature=1.000000 --final-temperature=0.001000 --temperature-per-level=3 --repeat-per-temperature=1"
DIFOPTS="--thresh=9 --old -f"

return

mkdir -p $OUTDIR

./scq6 ${SCQOPTS} $SRCDIR/000.png -                   $NUMCOL $OUTDIR/scq-000.fg.gif --opaque=$OUTDIR/img-000.gif 
./scq6 ${SCQOPTS} $SRCDIR/001.png $OUTDIR/img-000.gif $NUMCOL $OUTDIR/scq-001.fg.gif --opaque=$OUTDIR/scq-001.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-001.gif $OUTDIR/scq-001.fg.gif $OUTDIR/img-000.gif --opaque=$OUTDIR/img-001.gif
./scq6 ${SCQOPTS} $SRCDIR/002.png $OUTDIR/img-001.gif $NUMCOL $OUTDIR/scq-002.fg.gif --opaque=$OUTDIR/scq-002.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-002.gif $OUTDIR/scq-002.fg.gif $OUTDIR/img-001.gif --opaque=$OUTDIR/img-002.gif
./scq6 ${SCQOPTS} $SRCDIR/003.png $OUTDIR/img-002.gif $NUMCOL $OUTDIR/scq-003.fg.gif --opaque=$OUTDIR/scq-003.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-003.gif $OUTDIR/scq-003.fg.gif $OUTDIR/img-002.gif --opaque=$OUTDIR/img-003.gif
./scq6 ${SCQOPTS} $SRCDIR/004.png $OUTDIR/img-003.gif $NUMCOL $OUTDIR/scq-004.fg.gif --opaque=$OUTDIR/scq-004.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-004.gif $OUTDIR/scq-004.fg.gif $OUTDIR/img-003.gif --opaque=$OUTDIR/img-004.gif
./scq6 ${SCQOPTS} $SRCDIR/005.png $OUTDIR/img-004.gif $NUMCOL $OUTDIR/scq-005.fg.gif --opaque=$OUTDIR/scq-005.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-005.gif $OUTDIR/scq-005.fg.gif $OUTDIR/img-004.gif --opaque=$OUTDIR/img-005.gif
./scq6 ${SCQOPTS} $SRCDIR/006.png $OUTDIR/img-005.gif $NUMCOL $OUTDIR/scq-006.fg.gif --opaque=$OUTDIR/scq-006.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-006.gif $OUTDIR/scq-006.fg.gif $OUTDIR/img-005.gif --opaque=$OUTDIR/img-006.gif
./scq6 ${SCQOPTS} $SRCDIR/007.png $OUTDIR/img-006.gif $NUMCOL $OUTDIR/scq-007.fg.gif --opaque=$OUTDIR/scq-007.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-007.gif $OUTDIR/scq-007.fg.gif $OUTDIR/img-006.gif --opaque=$OUTDIR/img-007.gif
./scq6 ${SCQOPTS} $SRCDIR/008.png $OUTDIR/img-007.gif $NUMCOL $OUTDIR/scq-008.fg.gif --opaque=$OUTDIR/scq-008.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-008.gif $OUTDIR/scq-008.fg.gif $OUTDIR/img-007.gif --opaque=$OUTDIR/img-008.gif
./scq6 ${SCQOPTS} $SRCDIR/009.png $OUTDIR/img-008.gif $NUMCOL $OUTDIR/scq-009.fg.gif --opaque=$OUTDIR/scq-009.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-009.gif $OUTDIR/scq-009.fg.gif $OUTDIR/img-008.gif --opaque=$OUTDIR/img-009.gif
./scq6 ${SCQOPTS} $SRCDIR/010.png $OUTDIR/img-009.gif $NUMCOL $OUTDIR/scq-010.fg.gif --opaque=$OUTDIR/scq-010.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-010.gif $OUTDIR/scq-010.fg.gif $OUTDIR/img-009.gif --opaque=$OUTDIR/img-010.gif
./scq6 ${SCQOPTS} $SRCDIR/011.png $OUTDIR/img-010.gif $NUMCOL $OUTDIR/scq-011.fg.gif --opaque=$OUTDIR/scq-011.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-011.gif $OUTDIR/scq-011.fg.gif $OUTDIR/img-010.gif --opaque=$OUTDIR/img-011.gif
./scq6 ${SCQOPTS} $SRCDIR/012.png $OUTDIR/img-011.gif $NUMCOL $OUTDIR/scq-012.fg.gif --opaque=$OUTDIR/scq-012.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-012.gif $OUTDIR/scq-012.fg.gif $OUTDIR/img-011.gif --opaque=$OUTDIR/img-012.gif
./scq6 ${SCQOPTS} $SRCDIR/013.png $OUTDIR/img-012.gif $NUMCOL $OUTDIR/scq-013.fg.gif --opaque=$OUTDIR/scq-013.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-013.gif $OUTDIR/scq-013.fg.gif $OUTDIR/img-012.gif --opaque=$OUTDIR/img-013.gif
./scq6 ${SCQOPTS} $SRCDIR/014.png $OUTDIR/img-013.gif $NUMCOL $OUTDIR/scq-014.fg.gif --opaque=$OUTDIR/scq-014.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-014.gif $OUTDIR/scq-014.fg.gif $OUTDIR/img-013.gif --opaque=$OUTDIR/img-014.gif
./scq6 ${SCQOPTS} $SRCDIR/015.png $OUTDIR/img-014.gif $NUMCOL $OUTDIR/scq-015.fg.gif --opaque=$OUTDIR/scq-015.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-015.gif $OUTDIR/scq-015.fg.gif $OUTDIR/img-014.gif --opaque=$OUTDIR/img-015.gif
./scq6 ${SCQOPTS} $SRCDIR/016.png $OUTDIR/img-015.gif $NUMCOL $OUTDIR/scq-016.fg.gif --opaque=$OUTDIR/scq-016.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-016.gif $OUTDIR/scq-016.fg.gif $OUTDIR/img-015.gif --opaque=$OUTDIR/img-016.gif
./scq6 ${SCQOPTS} $SRCDIR/017.png $OUTDIR/img-016.gif $NUMCOL $OUTDIR/scq-017.fg.gif --opaque=$OUTDIR/scq-017.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-017.gif $OUTDIR/scq-017.fg.gif $OUTDIR/img-016.gif --opaque=$OUTDIR/img-017.gif
./scq6 ${SCQOPTS} $SRCDIR/018.png $OUTDIR/img-017.gif $NUMCOL $OUTDIR/scq-018.fg.gif --opaque=$OUTDIR/scq-018.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-018.gif $OUTDIR/scq-018.fg.gif $OUTDIR/img-017.gif --opaque=$OUTDIR/img-018.gif
./scq6 ${SCQOPTS} $SRCDIR/019.png $OUTDIR/img-018.gif $NUMCOL $OUTDIR/scq-019.fg.gif --opaque=$OUTDIR/scq-019.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-019.gif $OUTDIR/scq-019.fg.gif $OUTDIR/img-018.gif --opaque=$OUTDIR/img-019.gif
./scq6 ${SCQOPTS} $SRCDIR/020.png $OUTDIR/img-019.gif $NUMCOL $OUTDIR/scq-020.fg.gif --opaque=$OUTDIR/scq-020.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-020.gif $OUTDIR/scq-020.fg.gif $OUTDIR/img-019.gif --opaque=$OUTDIR/img-020.gif
./scq6 ${SCQOPTS} $SRCDIR/021.png $OUTDIR/img-020.gif $NUMCOL $OUTDIR/scq-021.fg.gif --opaque=$OUTDIR/scq-021.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-021.gif $OUTDIR/scq-021.fg.gif $OUTDIR/img-020.gif --opaque=$OUTDIR/img-021.gif
./scq6 ${SCQOPTS} $SRCDIR/022.png $OUTDIR/img-021.gif $NUMCOL $OUTDIR/scq-022.fg.gif --opaque=$OUTDIR/scq-022.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-022.gif $OUTDIR/scq-022.fg.gif $OUTDIR/img-021.gif --opaque=$OUTDIR/img-022.gif
./scq6 ${SCQOPTS} $SRCDIR/023.png $OUTDIR/img-022.gif $NUMCOL $OUTDIR/scq-023.fg.gif --opaque=$OUTDIR/scq-023.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-023.gif $OUTDIR/scq-023.fg.gif $OUTDIR/img-022.gif --opaque=$OUTDIR/img-023.gif
./scq6 ${SCQOPTS} $SRCDIR/024.png $OUTDIR/img-023.gif $NUMCOL $OUTDIR/scq-024.fg.gif --opaque=$OUTDIR/scq-024.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-024.gif $OUTDIR/scq-024.fg.gif $OUTDIR/img-023.gif --opaque=$OUTDIR/img-024.gif
./scq6 ${SCQOPTS} $SRCDIR/025.png $OUTDIR/img-024.gif $NUMCOL $OUTDIR/scq-025.fg.gif --opaque=$OUTDIR/scq-025.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-025.gif $OUTDIR/scq-025.fg.gif $OUTDIR/img-024.gif --opaque=$OUTDIR/img-025.gif
./scq6 ${SCQOPTS} $SRCDIR/026.png $OUTDIR/img-025.gif $NUMCOL $OUTDIR/scq-026.fg.gif --opaque=$OUTDIR/scq-026.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-026.gif $OUTDIR/scq-026.fg.gif $OUTDIR/img-025.gif --opaque=$OUTDIR/img-026.gif
./scq6 ${SCQOPTS} $SRCDIR/027.png $OUTDIR/img-026.gif $NUMCOL $OUTDIR/scq-027.fg.gif --opaque=$OUTDIR/scq-027.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-027.gif $OUTDIR/scq-027.fg.gif $OUTDIR/img-026.gif --opaque=$OUTDIR/img-027.gif
./scq6 ${SCQOPTS} $SRCDIR/028.png $OUTDIR/img-027.gif $NUMCOL $OUTDIR/scq-028.fg.gif --opaque=$OUTDIR/scq-028.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-028.gif $OUTDIR/scq-028.fg.gif $OUTDIR/img-027.gif --opaque=$OUTDIR/img-028.gif
./scq6 ${SCQOPTS} $SRCDIR/029.png $OUTDIR/img-028.gif $NUMCOL $OUTDIR/scq-029.fg.gif --opaque=$OUTDIR/scq-029.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-029.gif $OUTDIR/scq-029.fg.gif $OUTDIR/img-028.gif --opaque=$OUTDIR/img-029.gif
./scq6 ${SCQOPTS} $SRCDIR/030.png $OUTDIR/img-029.gif $NUMCOL $OUTDIR/scq-030.fg.gif --opaque=$OUTDIR/scq-030.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-030.gif $OUTDIR/scq-030.fg.gif $OUTDIR/img-029.gif --opaque=$OUTDIR/img-030.gif
./scq6 ${SCQOPTS} $SRCDIR/031.png $OUTDIR/img-030.gif $NUMCOL $OUTDIR/scq-031.fg.gif --opaque=$OUTDIR/scq-031.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-031.gif $OUTDIR/scq-031.fg.gif $OUTDIR/img-030.gif --opaque=$OUTDIR/img-031.gif
./scq6 ${SCQOPTS} $SRCDIR/032.png $OUTDIR/img-031.gif $NUMCOL $OUTDIR/scq-032.fg.gif --opaque=$OUTDIR/scq-032.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-032.gif $OUTDIR/scq-032.fg.gif $OUTDIR/img-031.gif --opaque=$OUTDIR/img-032.gif
./scq6 ${SCQOPTS} $SRCDIR/033.png $OUTDIR/img-032.gif $NUMCOL $OUTDIR/scq-033.fg.gif --opaque=$OUTDIR/scq-033.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-033.gif $OUTDIR/scq-033.fg.gif $OUTDIR/img-032.gif --opaque=$OUTDIR/img-033.gif
./scq6 ${SCQOPTS} $SRCDIR/034.png $OUTDIR/img-033.gif $NUMCOL $OUTDIR/scq-034.fg.gif --opaque=$OUTDIR/scq-034.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-034.gif $OUTDIR/scq-034.fg.gif $OUTDIR/img-033.gif --opaque=$OUTDIR/img-034.gif
./scq6 ${SCQOPTS} $SRCDIR/035.png $OUTDIR/img-034.gif $NUMCOL $OUTDIR/scq-035.fg.gif --opaque=$OUTDIR/scq-035.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-035.gif $OUTDIR/scq-035.fg.gif $OUTDIR/img-034.gif --opaque=$OUTDIR/img-035.gif
./scq6 ${SCQOPTS} $SRCDIR/036.png $OUTDIR/img-035.gif $NUMCOL $OUTDIR/scq-036.fg.gif --opaque=$OUTDIR/scq-036.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-036.gif $OUTDIR/scq-036.fg.gif $OUTDIR/img-035.gif --opaque=$OUTDIR/img-036.gif
./scq6 ${SCQOPTS} $SRCDIR/037.png $OUTDIR/img-036.gif $NUMCOL $OUTDIR/scq-037.fg.gif --opaque=$OUTDIR/scq-037.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-037.gif $OUTDIR/scq-037.fg.gif $OUTDIR/img-036.gif --opaque=$OUTDIR/img-037.gif
./scq6 ${SCQOPTS} $SRCDIR/038.png $OUTDIR/img-037.gif $NUMCOL $OUTDIR/scq-038.fg.gif --opaque=$OUTDIR/scq-038.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-038.gif $OUTDIR/scq-038.fg.gif $OUTDIR/img-037.gif --opaque=$OUTDIR/img-038.gif
./scq6 ${SCQOPTS} $SRCDIR/039.png $OUTDIR/img-038.gif $NUMCOL $OUTDIR/scq-039.fg.gif --opaque=$OUTDIR/scq-039.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-039.gif $OUTDIR/scq-039.fg.gif $OUTDIR/img-038.gif --opaque=$OUTDIR/img-039.gif
./scq6 ${SCQOPTS} $SRCDIR/040.png $OUTDIR/img-039.gif $NUMCOL $OUTDIR/scq-040.fg.gif --opaque=$OUTDIR/scq-040.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-040.gif $OUTDIR/scq-040.fg.gif $OUTDIR/img-039.gif --opaque=$OUTDIR/img-040.gif
./scq6 ${SCQOPTS} $SRCDIR/041.png $OUTDIR/img-040.gif $NUMCOL $OUTDIR/scq-041.fg.gif --opaque=$OUTDIR/scq-041.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-041.gif $OUTDIR/scq-041.fg.gif $OUTDIR/img-040.gif --opaque=$OUTDIR/img-041.gif
./scq6 ${SCQOPTS} $SRCDIR/042.png $OUTDIR/img-041.gif $NUMCOL $OUTDIR/scq-042.fg.gif --opaque=$OUTDIR/scq-042.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-042.gif $OUTDIR/scq-042.fg.gif $OUTDIR/img-041.gif --opaque=$OUTDIR/img-042.gif
./scq6 ${SCQOPTS} $SRCDIR/043.png $OUTDIR/img-042.gif $NUMCOL $OUTDIR/scq-043.fg.gif --opaque=$OUTDIR/scq-043.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-043.gif $OUTDIR/scq-043.fg.gif $OUTDIR/img-042.gif --opaque=$OUTDIR/img-043.gif
./scq6 ${SCQOPTS} $SRCDIR/044.png $OUTDIR/img-043.gif $NUMCOL $OUTDIR/scq-044.fg.gif --opaque=$OUTDIR/scq-044.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-044.gif $OUTDIR/scq-044.fg.gif $OUTDIR/img-043.gif --opaque=$OUTDIR/img-044.gif
./scq6 ${SCQOPTS} $SRCDIR/045.png $OUTDIR/img-044.gif $NUMCOL $OUTDIR/scq-045.fg.gif --opaque=$OUTDIR/scq-045.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-045.gif $OUTDIR/scq-045.fg.gif $OUTDIR/img-044.gif --opaque=$OUTDIR/img-045.gif
./scq6 ${SCQOPTS} $SRCDIR/046.png $OUTDIR/img-045.gif $NUMCOL $OUTDIR/scq-046.fg.gif --opaque=$OUTDIR/scq-046.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-046.gif $OUTDIR/scq-046.fg.gif $OUTDIR/img-045.gif --opaque=$OUTDIR/img-046.gif
./scq6 ${SCQOPTS} $SRCDIR/047.png $OUTDIR/img-046.gif $NUMCOL $OUTDIR/scq-047.fg.gif --opaque=$OUTDIR/scq-047.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-047.gif $OUTDIR/scq-047.fg.gif $OUTDIR/img-046.gif --opaque=$OUTDIR/img-047.gif
./scq6 ${SCQOPTS} $SRCDIR/048.png $OUTDIR/img-047.gif $NUMCOL $OUTDIR/scq-048.fg.gif --opaque=$OUTDIR/scq-048.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-048.gif $OUTDIR/scq-048.fg.gif $OUTDIR/img-047.gif --opaque=$OUTDIR/img-048.gif
./scq6 ${SCQOPTS} $SRCDIR/049.png $OUTDIR/img-048.gif $NUMCOL $OUTDIR/scq-049.fg.gif --opaque=$OUTDIR/scq-049.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-049.gif $OUTDIR/scq-049.fg.gif $OUTDIR/img-048.gif --opaque=$OUTDIR/img-049.gif
./scq6 ${SCQOPTS} $SRCDIR/050.png $OUTDIR/img-049.gif $NUMCOL $OUTDIR/scq-050.fg.gif --opaque=$OUTDIR/scq-050.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-050.gif $OUTDIR/scq-050.fg.gif $OUTDIR/img-049.gif --opaque=$OUTDIR/img-050.gif
./scq6 ${SCQOPTS} $SRCDIR/051.png $OUTDIR/img-050.gif $NUMCOL $OUTDIR/scq-051.fg.gif --opaque=$OUTDIR/scq-051.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-051.gif $OUTDIR/scq-051.fg.gif $OUTDIR/img-050.gif --opaque=$OUTDIR/img-051.gif
./scq6 ${SCQOPTS} $SRCDIR/052.png $OUTDIR/img-051.gif $NUMCOL $OUTDIR/scq-052.fg.gif --opaque=$OUTDIR/scq-052.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-052.gif $OUTDIR/scq-052.fg.gif $OUTDIR/img-051.gif --opaque=$OUTDIR/img-052.gif
./scq6 ${SCQOPTS} $SRCDIR/053.png $OUTDIR/img-052.gif $NUMCOL $OUTDIR/scq-053.fg.gif --opaque=$OUTDIR/scq-053.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-053.gif $OUTDIR/scq-053.fg.gif $OUTDIR/img-052.gif --opaque=$OUTDIR/img-053.gif
./scq6 ${SCQOPTS} $SRCDIR/054.png $OUTDIR/img-053.gif $NUMCOL $OUTDIR/scq-054.fg.gif --opaque=$OUTDIR/scq-054.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-054.gif $OUTDIR/scq-054.fg.gif $OUTDIR/img-053.gif --opaque=$OUTDIR/img-054.gif
./scq6 ${SCQOPTS} $SRCDIR/055.png $OUTDIR/img-054.gif $NUMCOL $OUTDIR/scq-055.fg.gif --opaque=$OUTDIR/scq-055.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-055.gif $OUTDIR/scq-055.fg.gif $OUTDIR/img-054.gif --opaque=$OUTDIR/img-055.gif
./scq6 ${SCQOPTS} $SRCDIR/056.png $OUTDIR/img-055.gif $NUMCOL $OUTDIR/scq-056.fg.gif --opaque=$OUTDIR/scq-056.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-056.gif $OUTDIR/scq-056.fg.gif $OUTDIR/img-055.gif --opaque=$OUTDIR/img-056.gif
./scq6 ${SCQOPTS} $SRCDIR/057.png $OUTDIR/img-056.gif $NUMCOL $OUTDIR/scq-057.fg.gif --opaque=$OUTDIR/scq-057.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-057.gif $OUTDIR/scq-057.fg.gif $OUTDIR/img-056.gif --opaque=$OUTDIR/img-057.gif
./scq6 ${SCQOPTS} $SRCDIR/058.png $OUTDIR/img-057.gif $NUMCOL $OUTDIR/scq-058.fg.gif --opaque=$OUTDIR/scq-058.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-058.gif $OUTDIR/scq-058.fg.gif $OUTDIR/img-057.gif --opaque=$OUTDIR/img-058.gif
./scq6 ${SCQOPTS} $SRCDIR/059.png $OUTDIR/img-058.gif $NUMCOL $OUTDIR/scq-059.fg.gif --opaque=$OUTDIR/scq-059.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-059.gif $OUTDIR/scq-059.fg.gif $OUTDIR/img-058.gif --opaque=$OUTDIR/img-059.gif
./scq6 ${SCQOPTS} $SRCDIR/060.png $OUTDIR/img-059.gif $NUMCOL $OUTDIR/scq-060.fg.gif --opaque=$OUTDIR/scq-060.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-060.gif $OUTDIR/scq-060.fg.gif $OUTDIR/img-059.gif --opaque=$OUTDIR/img-060.gif
./scq6 ${SCQOPTS} $SRCDIR/061.png $OUTDIR/img-060.gif $NUMCOL $OUTDIR/scq-061.fg.gif --opaque=$OUTDIR/scq-061.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-061.gif $OUTDIR/scq-061.fg.gif $OUTDIR/img-060.gif --opaque=$OUTDIR/img-061.gif
./scq6 ${SCQOPTS} $SRCDIR/062.png $OUTDIR/img-061.gif $NUMCOL $OUTDIR/scq-062.fg.gif --opaque=$OUTDIR/scq-062.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-062.gif $OUTDIR/scq-062.fg.gif $OUTDIR/img-061.gif --opaque=$OUTDIR/img-062.gif
./scq6 ${SCQOPTS} $SRCDIR/063.png $OUTDIR/img-062.gif $NUMCOL $OUTDIR/scq-063.fg.gif --opaque=$OUTDIR/scq-063.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-063.gif $OUTDIR/scq-063.fg.gif $OUTDIR/img-062.gif --opaque=$OUTDIR/img-063.gif
./scq6 ${SCQOPTS} $SRCDIR/064.png $OUTDIR/img-063.gif $NUMCOL $OUTDIR/scq-064.fg.gif --opaque=$OUTDIR/scq-064.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-064.gif $OUTDIR/scq-064.fg.gif $OUTDIR/img-063.gif --opaque=$OUTDIR/img-064.gif
./scq6 ${SCQOPTS} $SRCDIR/065.png $OUTDIR/img-064.gif $NUMCOL $OUTDIR/scq-065.fg.gif --opaque=$OUTDIR/scq-065.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-065.gif $OUTDIR/scq-065.fg.gif $OUTDIR/img-064.gif --opaque=$OUTDIR/img-065.gif
./scq6 ${SCQOPTS} $SRCDIR/066.png $OUTDIR/img-065.gif $NUMCOL $OUTDIR/scq-066.fg.gif --opaque=$OUTDIR/scq-066.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-066.gif $OUTDIR/scq-066.fg.gif $OUTDIR/img-065.gif --opaque=$OUTDIR/img-066.gif
./scq6 ${SCQOPTS} $SRCDIR/067.png $OUTDIR/img-066.gif $NUMCOL $OUTDIR/scq-067.fg.gif --opaque=$OUTDIR/scq-067.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-067.gif $OUTDIR/scq-067.fg.gif $OUTDIR/img-066.gif --opaque=$OUTDIR/img-067.gif
./scq6 ${SCQOPTS} $SRCDIR/068.png $OUTDIR/img-067.gif $NUMCOL $OUTDIR/scq-068.fg.gif --opaque=$OUTDIR/scq-068.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-068.gif $OUTDIR/scq-068.fg.gif $OUTDIR/img-067.gif --opaque=$OUTDIR/img-068.gif
./scq6 ${SCQOPTS} $SRCDIR/069.png $OUTDIR/img-068.gif $NUMCOL $OUTDIR/scq-069.fg.gif --opaque=$OUTDIR/scq-069.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-069.gif $OUTDIR/scq-069.fg.gif $OUTDIR/img-068.gif --opaque=$OUTDIR/img-069.gif
./scq6 ${SCQOPTS} $SRCDIR/070.png $OUTDIR/img-069.gif $NUMCOL $OUTDIR/scq-070.fg.gif --opaque=$OUTDIR/scq-070.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-070.gif $OUTDIR/scq-070.fg.gif $OUTDIR/img-069.gif --opaque=$OUTDIR/img-070.gif
./scq6 ${SCQOPTS} $SRCDIR/071.png $OUTDIR/img-070.gif $NUMCOL $OUTDIR/scq-071.fg.gif --opaque=$OUTDIR/scq-071.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-071.gif $OUTDIR/scq-071.fg.gif $OUTDIR/img-070.gif --opaque=$OUTDIR/img-071.gif
./scq6 ${SCQOPTS} $SRCDIR/072.png $OUTDIR/img-071.gif $NUMCOL $OUTDIR/scq-072.fg.gif --opaque=$OUTDIR/scq-072.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-072.gif $OUTDIR/scq-072.fg.gif $OUTDIR/img-071.gif --opaque=$OUTDIR/img-072.gif
./scq6 ${SCQOPTS} $SRCDIR/073.png $OUTDIR/img-072.gif $NUMCOL $OUTDIR/scq-073.fg.gif --opaque=$OUTDIR/scq-073.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-073.gif $OUTDIR/scq-073.fg.gif $OUTDIR/img-072.gif --opaque=$OUTDIR/img-073.gif
./scq6 ${SCQOPTS} $SRCDIR/074.png $OUTDIR/img-073.gif $NUMCOL $OUTDIR/scq-074.fg.gif --opaque=$OUTDIR/scq-074.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-074.gif $OUTDIR/scq-074.fg.gif $OUTDIR/img-073.gif --opaque=$OUTDIR/img-074.gif
./scq6 ${SCQOPTS} $SRCDIR/075.png $OUTDIR/img-074.gif $NUMCOL $OUTDIR/scq-075.fg.gif --opaque=$OUTDIR/scq-075.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-075.gif $OUTDIR/scq-075.fg.gif $OUTDIR/img-074.gif --opaque=$OUTDIR/img-075.gif
./scq6 ${SCQOPTS} $SRCDIR/076.png $OUTDIR/img-075.gif $NUMCOL $OUTDIR/scq-076.fg.gif --opaque=$OUTDIR/scq-076.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-076.gif $OUTDIR/scq-076.fg.gif $OUTDIR/img-075.gif --opaque=$OUTDIR/img-076.gif
./scq6 ${SCQOPTS} $SRCDIR/077.png $OUTDIR/img-076.gif $NUMCOL $OUTDIR/scq-077.fg.gif --opaque=$OUTDIR/scq-077.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-077.gif $OUTDIR/scq-077.fg.gif $OUTDIR/img-076.gif --opaque=$OUTDIR/img-077.gif
./scq6 ${SCQOPTS} $SRCDIR/078.png $OUTDIR/img-077.gif $NUMCOL $OUTDIR/scq-078.fg.gif --opaque=$OUTDIR/scq-078.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-078.gif $OUTDIR/scq-078.fg.gif $OUTDIR/img-077.gif --opaque=$OUTDIR/img-078.gif
./scq6 ${SCQOPTS} $SRCDIR/079.png $OUTDIR/img-078.gif $NUMCOL $OUTDIR/scq-079.fg.gif --opaque=$OUTDIR/scq-079.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-079.gif $OUTDIR/scq-079.fg.gif $OUTDIR/img-078.gif --opaque=$OUTDIR/img-079.gif
./scq6 ${SCQOPTS} $SRCDIR/080.png $OUTDIR/img-079.gif $NUMCOL $OUTDIR/scq-080.fg.gif --opaque=$OUTDIR/scq-080.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-080.gif $OUTDIR/scq-080.fg.gif $OUTDIR/img-079.gif --opaque=$OUTDIR/img-080.gif
./scq6 ${SCQOPTS} $SRCDIR/081.png $OUTDIR/img-080.gif $NUMCOL $OUTDIR/scq-081.fg.gif --opaque=$OUTDIR/scq-081.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-081.gif $OUTDIR/scq-081.fg.gif $OUTDIR/img-080.gif --opaque=$OUTDIR/img-081.gif
./scq6 ${SCQOPTS} $SRCDIR/082.png $OUTDIR/img-081.gif $NUMCOL $OUTDIR/scq-082.fg.gif --opaque=$OUTDIR/scq-082.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-082.gif $OUTDIR/scq-082.fg.gif $OUTDIR/img-081.gif --opaque=$OUTDIR/img-082.gif
./scq6 ${SCQOPTS} $SRCDIR/083.png $OUTDIR/img-082.gif $NUMCOL $OUTDIR/scq-083.fg.gif --opaque=$OUTDIR/scq-083.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-083.gif $OUTDIR/scq-083.fg.gif $OUTDIR/img-082.gif --opaque=$OUTDIR/img-083.gif
./scq6 ${SCQOPTS} $SRCDIR/084.png $OUTDIR/img-083.gif $NUMCOL $OUTDIR/scq-084.fg.gif --opaque=$OUTDIR/scq-084.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-084.gif $OUTDIR/scq-084.fg.gif $OUTDIR/img-083.gif --opaque=$OUTDIR/img-084.gif
./scq6 ${SCQOPTS} $SRCDIR/085.png $OUTDIR/img-084.gif $NUMCOL $OUTDIR/scq-085.fg.gif --opaque=$OUTDIR/scq-085.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-085.gif $OUTDIR/scq-085.fg.gif $OUTDIR/img-084.gif --opaque=$OUTDIR/img-085.gif
./scq6 ${SCQOPTS} $SRCDIR/086.png $OUTDIR/img-085.gif $NUMCOL $OUTDIR/scq-086.fg.gif --opaque=$OUTDIR/scq-086.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-086.gif $OUTDIR/scq-086.fg.gif $OUTDIR/img-085.gif --opaque=$OUTDIR/img-086.gif
./scq6 ${SCQOPTS} $SRCDIR/087.png $OUTDIR/img-086.gif $NUMCOL $OUTDIR/scq-087.fg.gif --opaque=$OUTDIR/scq-087.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-087.gif $OUTDIR/scq-087.fg.gif $OUTDIR/img-086.gif --opaque=$OUTDIR/img-087.gif
./scq6 ${SCQOPTS} $SRCDIR/088.png $OUTDIR/img-087.gif $NUMCOL $OUTDIR/scq-088.fg.gif --opaque=$OUTDIR/scq-088.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-088.gif $OUTDIR/scq-088.fg.gif $OUTDIR/img-087.gif --opaque=$OUTDIR/img-088.gif
./scq6 ${SCQOPTS} $SRCDIR/089.png $OUTDIR/img-088.gif $NUMCOL $OUTDIR/scq-089.fg.gif --opaque=$OUTDIR/scq-089.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-089.gif $OUTDIR/scq-089.fg.gif $OUTDIR/img-088.gif --opaque=$OUTDIR/img-089.gif
./scq6 ${SCQOPTS} $SRCDIR/090.png $OUTDIR/img-089.gif $NUMCOL $OUTDIR/scq-090.fg.gif --opaque=$OUTDIR/scq-090.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-090.gif $OUTDIR/scq-090.fg.gif $OUTDIR/img-089.gif --opaque=$OUTDIR/img-090.gif
./scq6 ${SCQOPTS} $SRCDIR/091.png $OUTDIR/img-090.gif $NUMCOL $OUTDIR/scq-091.fg.gif --opaque=$OUTDIR/scq-091.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-091.gif $OUTDIR/scq-091.fg.gif $OUTDIR/img-090.gif --opaque=$OUTDIR/img-091.gif
./scq6 ${SCQOPTS} $SRCDIR/092.png $OUTDIR/img-091.gif $NUMCOL $OUTDIR/scq-092.fg.gif --opaque=$OUTDIR/scq-092.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-092.gif $OUTDIR/scq-092.fg.gif $OUTDIR/img-091.gif --opaque=$OUTDIR/img-092.gif
./scq6 ${SCQOPTS} $SRCDIR/093.png $OUTDIR/img-092.gif $NUMCOL $OUTDIR/scq-093.fg.gif --opaque=$OUTDIR/scq-093.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-093.gif $OUTDIR/scq-093.fg.gif $OUTDIR/img-092.gif --opaque=$OUTDIR/img-093.gif
./scq6 ${SCQOPTS} $SRCDIR/094.png $OUTDIR/img-093.gif $NUMCOL $OUTDIR/scq-094.fg.gif --opaque=$OUTDIR/scq-094.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-094.gif $OUTDIR/scq-094.fg.gif $OUTDIR/img-093.gif --opaque=$OUTDIR/img-094.gif
./scq6 ${SCQOPTS} $SRCDIR/095.png $OUTDIR/img-094.gif $NUMCOL $OUTDIR/scq-095.fg.gif --opaque=$OUTDIR/scq-095.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-095.gif $OUTDIR/scq-095.fg.gif $OUTDIR/img-094.gif --opaque=$OUTDIR/img-095.gif
./scq6 ${SCQOPTS} $SRCDIR/096.png $OUTDIR/img-095.gif $NUMCOL $OUTDIR/scq-096.fg.gif --opaque=$OUTDIR/scq-096.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-096.gif $OUTDIR/scq-096.fg.gif $OUTDIR/img-095.gif --opaque=$OUTDIR/img-096.gif
./scq6 ${SCQOPTS} $SRCDIR/097.png $OUTDIR/img-096.gif $NUMCOL $OUTDIR/scq-097.fg.gif --opaque=$OUTDIR/scq-097.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-097.gif $OUTDIR/scq-097.fg.gif $OUTDIR/img-096.gif --opaque=$OUTDIR/img-097.gif
./scq6 ${SCQOPTS} $SRCDIR/098.png $OUTDIR/img-097.gif $NUMCOL $OUTDIR/scq-098.fg.gif --opaque=$OUTDIR/scq-098.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-098.gif $OUTDIR/scq-098.fg.gif $OUTDIR/img-097.gif --opaque=$OUTDIR/img-098.gif
./scq6 ${SCQOPTS} $SRCDIR/099.png $OUTDIR/img-098.gif $NUMCOL $OUTDIR/scq-099.fg.gif --opaque=$OUTDIR/scq-099.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-099.gif $OUTDIR/scq-099.fg.gif $OUTDIR/img-098.gif --opaque=$OUTDIR/img-099.gif
./scq6 ${SCQOPTS} $SRCDIR/100.png $OUTDIR/img-099.gif $NUMCOL $OUTDIR/scq-100.fg.gif --opaque=$OUTDIR/scq-100.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-100.gif $OUTDIR/scq-100.fg.gif $OUTDIR/img-099.gif --opaque=$OUTDIR/img-100.gif
./scq6 ${SCQOPTS} $SRCDIR/101.png $OUTDIR/img-100.gif $NUMCOL $OUTDIR/scq-101.fg.gif --opaque=$OUTDIR/scq-101.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-101.gif $OUTDIR/scq-101.fg.gif $OUTDIR/img-100.gif --opaque=$OUTDIR/img-101.gif
./scq6 ${SCQOPTS} $SRCDIR/102.png $OUTDIR/img-101.gif $NUMCOL $OUTDIR/scq-102.fg.gif --opaque=$OUTDIR/scq-102.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-102.gif $OUTDIR/scq-102.fg.gif $OUTDIR/img-101.gif --opaque=$OUTDIR/img-102.gif
./scq6 ${SCQOPTS} $SRCDIR/103.png $OUTDIR/img-102.gif $NUMCOL $OUTDIR/scq-103.fg.gif --opaque=$OUTDIR/scq-103.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-103.gif $OUTDIR/scq-103.fg.gif $OUTDIR/img-102.gif --opaque=$OUTDIR/img-103.gif
./scq6 ${SCQOPTS} $SRCDIR/104.png $OUTDIR/img-103.gif $NUMCOL $OUTDIR/scq-104.fg.gif --opaque=$OUTDIR/scq-104.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-104.gif $OUTDIR/scq-104.fg.gif $OUTDIR/img-103.gif --opaque=$OUTDIR/img-104.gif
./scq6 ${SCQOPTS} $SRCDIR/105.png $OUTDIR/img-104.gif $NUMCOL $OUTDIR/scq-105.fg.gif --opaque=$OUTDIR/scq-105.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-105.gif $OUTDIR/scq-105.fg.gif $OUTDIR/img-104.gif --opaque=$OUTDIR/img-105.gif
./scq6 ${SCQOPTS} $SRCDIR/106.png $OUTDIR/img-105.gif $NUMCOL $OUTDIR/scq-106.fg.gif --opaque=$OUTDIR/scq-106.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-106.gif $OUTDIR/scq-106.fg.gif $OUTDIR/img-105.gif --opaque=$OUTDIR/img-106.gif
./scq6 ${SCQOPTS} $SRCDIR/107.png $OUTDIR/img-106.gif $NUMCOL $OUTDIR/scq-107.fg.gif --opaque=$OUTDIR/scq-107.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-107.gif $OUTDIR/scq-107.fg.gif $OUTDIR/img-106.gif --opaque=$OUTDIR/img-107.gif
./scq6 ${SCQOPTS} $SRCDIR/108.png $OUTDIR/img-107.gif $NUMCOL $OUTDIR/scq-108.fg.gif --opaque=$OUTDIR/scq-108.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-108.gif $OUTDIR/scq-108.fg.gif $OUTDIR/img-107.gif --opaque=$OUTDIR/img-108.gif
./scq6 ${SCQOPTS} $SRCDIR/109.png $OUTDIR/img-108.gif $NUMCOL $OUTDIR/scq-109.fg.gif --opaque=$OUTDIR/scq-109.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-109.gif $OUTDIR/scq-109.fg.gif $OUTDIR/img-108.gif --opaque=$OUTDIR/img-109.gif
./scq6 ${SCQOPTS} $SRCDIR/110.png $OUTDIR/img-109.gif $NUMCOL $OUTDIR/scq-110.fg.gif --opaque=$OUTDIR/scq-110.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-110.gif $OUTDIR/scq-110.fg.gif $OUTDIR/img-109.gif --opaque=$OUTDIR/img-110.gif
./scq6 ${SCQOPTS} $SRCDIR/111.png $OUTDIR/img-110.gif $NUMCOL $OUTDIR/scq-111.fg.gif --opaque=$OUTDIR/scq-111.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-111.gif $OUTDIR/scq-111.fg.gif $OUTDIR/img-110.gif --opaque=$OUTDIR/img-111.gif
./scq6 ${SCQOPTS} $SRCDIR/112.png $OUTDIR/img-111.gif $NUMCOL $OUTDIR/scq-112.fg.gif --opaque=$OUTDIR/scq-112.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-112.gif $OUTDIR/scq-112.fg.gif $OUTDIR/img-111.gif --opaque=$OUTDIR/img-112.gif
./scq6 ${SCQOPTS} $SRCDIR/113.png $OUTDIR/img-112.gif $NUMCOL $OUTDIR/scq-113.fg.gif --opaque=$OUTDIR/scq-113.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-113.gif $OUTDIR/scq-113.fg.gif $OUTDIR/img-112.gif --opaque=$OUTDIR/img-113.gif
./scq6 ${SCQOPTS} $SRCDIR/114.png $OUTDIR/img-113.gif $NUMCOL $OUTDIR/scq-114.fg.gif --opaque=$OUTDIR/scq-114.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-114.gif $OUTDIR/scq-114.fg.gif $OUTDIR/img-113.gif --opaque=$OUTDIR/img-114.gif
./scq6 ${SCQOPTS} $SRCDIR/115.png $OUTDIR/img-114.gif $NUMCOL $OUTDIR/scq-115.fg.gif --opaque=$OUTDIR/scq-115.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-115.gif $OUTDIR/scq-115.fg.gif $OUTDIR/img-114.gif --opaque=$OUTDIR/img-115.gif
./scq6 ${SCQOPTS} $SRCDIR/116.png $OUTDIR/img-115.gif $NUMCOL $OUTDIR/scq-116.fg.gif --opaque=$OUTDIR/scq-116.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-116.gif $OUTDIR/scq-116.fg.gif $OUTDIR/img-115.gif --opaque=$OUTDIR/img-116.gif
./scq6 ${SCQOPTS} $SRCDIR/117.png $OUTDIR/img-116.gif $NUMCOL $OUTDIR/scq-117.fg.gif --opaque=$OUTDIR/scq-117.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-117.gif $OUTDIR/scq-117.fg.gif $OUTDIR/img-116.gif --opaque=$OUTDIR/img-117.gif
./scq6 ${SCQOPTS} $SRCDIR/118.png $OUTDIR/img-117.gif $NUMCOL $OUTDIR/scq-118.fg.gif --opaque=$OUTDIR/scq-118.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-118.gif $OUTDIR/scq-118.fg.gif $OUTDIR/img-117.gif --opaque=$OUTDIR/img-118.gif
./scq6 ${SCQOPTS} $SRCDIR/119.png $OUTDIR/img-118.gif $NUMCOL $OUTDIR/scq-119.fg.gif --opaque=$OUTDIR/scq-119.bg.gif; ./diffgif ${DIFOPTS} $OUTDIR/diff-119.gif $OUTDIR/scq-119.fg.gif $OUTDIR/img-118.gif --opaque=$OUTDIR/img-119.gif
