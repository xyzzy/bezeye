<?php

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

if (empty($argv[1]) || empty($argv[2]))
    die ('usage: '.$argv[0]. ' <wingOutline> <fileTemplate>'."\n");

$v0 = 0.65; // 0.55
$a0 = 0.01;
ini_set('memory_limit','3g');

function rgb($ang, $amp=1)
{
global $im;

	$ang = $ang-floor($ang);
	$ang *= 6;

		if ($ang < 1) {
			$r = 1;
			$g = $ang-0;
			$b = 0;
		} else if ($ang < 2) {
			$r = 2-$ang;
			$g = 1;
			$b = 0;
		} else if ($ang < 3) {
			$r = 0;
			$g = 1;
			$b = $ang-2;
		} else if ($ang < 4) {
			$r = 0;
			$g = 4-$ang;
			$b = 1;
		} else if ($ang < 5) {
			$r = $ang-4;
			$g = 0;
			$b = 1;
		} else {
			$r = 1;
			$g = 0;
			$b = 6-$ang;
		}

	$r *= 255;
$r = 255-(255-$r)*$amp;
	$g *= 255;
$g = 255-(255-$g)*$amp;
	$b *= 255;
$b = 255-(255-$b)*$amp;
	return imagecolorallocate($im, $r,$g,$b);
}

$_x = array();
$_y = array();
$_dx = array();
$_dy = array();
$_a = array();
$_v = array();
$_c = array();

$im0 = imagecreatefrompng($argv[1]);
if (!$im0)
    die ("wing outline not found\n");

$im = imagecreatetruecolor(792,1000);
imagesavealpha($im, true);
imagealphablending($im, false);
$white = imagecolorallocate($im, 255,255,255);
$black = imagecolorallocate($im, 0,0,0);
$green = imagecolorallocate($im, 0,255,0);
$blue = imagecolorallocate($im, 0,0,255);
$transp = imagecolorallocatealpha($im, 255,255,255,127);

//--- beginInit
$maxslice = 100;
$wmin = 50;
$wmax = 130;
$m = 10;
$coef = array(56.0/209.0, -15.0/209.0, 4.0/209.0, -1.0/209.0, 0, 1.0/209.0, -4.0/209.0, 15.0/209.0, -56.0/209.0, 1 );
$Ax = array (382,423,414,365,236,131,214, 88,100,240);
$Ay = array ( 80,209,362,421,464,347,263,178, 67, 16);

if (1) {
// 30
$Ax = array(411,421,423,423,422,416,401,365,328,286,242,200,165,138,133,162,200,203,164,125,88,67,78,106,144,186,231,275,318,357);
$Ay = array(128,172,217,262,307,352,394,420,446,463,465,449,421,385,342,308,284,248,225,204,178,139,96,61,36,21,16,21,36,58);
$summax = 1377.088348;
} else if (1) {
//60
$Ax = array(402,411,417,421,422,423,424,423,422,421,418,415,409,397,379,360,342,322,301,279,257,234,213,193,175,158,145,134,130,138,153,172,191,209,210,192,172,151,132,112,93,78,68,68,75,87,102,120,140,161,182,205,228,250,273,295,316,337,356,374);
$Ay = array(108,129,151,173,196,219,242,265,288,311,333,356,378,397,411,424,437,449,459,465,467,463,455,444,430,414,396,376,353,332,315,302,290,276,255,241,230,219,208,196,183,166,145,123,101,82,65,50,38,29,22,18,16,17,20,26,35,45,57,72);
$summax = 1381.443780;
} else {
// 120
$Ax = array(389,396,402,407,411,414,417,419,421,422,422,423,423,424,424,423,423,423,422,422,421,420,418,417,415,412,408,403,395,386,377,367,358,348,339,329,319,308,298,287,275,264,252,241,230,219,208,198,189,180,171,163,155,148,142,136,132,130,131,135,141,149,158,168,177,187,197,206,213,212,205,195,186,176,165,155,145,135,125,115,105,96,87,80,74,69,67,67,70,74,79,85,93,101,109,118,128,138,148,159,170,181,192,203,215,226,238,249,261,272,283,294,305,316,326,337,346,356,365,374);
$Ay = array(89,98,108,119,129,140,152,163,174,186,197,209,220,232,243,255,267,278,290,301,313,324,336,347,358,370,380,391,399,406,413,419,426,433,439,445,451,456,460,463,466,467,467,465,462,458,453,448,441,434,427,419,410,401,391,381,370,359,347,337,327,319,311,305,298,292,286,279,270,259,250,243,237,232,226,221,216,210,204,198,192,185,177,169,159,148,137,126,114,103,93,84,75,66,59,52,45,39,34,30,26,22,20,18,16,16,16,17,18,20,23,26,30,35,40,45,51,57,64,72);
$summax = 1383.186163;
}
$m = count($Ax);
$gen = 0;
printf("count(Ax):%d\n", count($Ax));

// rescale
if (1) {
	$xmin =  66; // 66.709622887307-0.0001;
	$xmax = 424; // 423.24696551749+0.0001;
	$ymin =  15; // 15.978061786642-0.0001;
	$ymax = 467; // 466.30044180059+0.0001;
	$scale = 1000/($ymax-$ymin);
$scale = 1;
	for ($i=0; $i<$m; $i++) {
		$Ax[$i] = ($Ax[$i]-$xmin)*$scale;
		$Ay[$i] = ($Ay[$i]-$ymin)*$scale;
		$Ax[$i] = round($Ax[$i]);
		$Ay[$i] = round($Ay[$i]);
	}
	echo 'Ax[] = '.json_encode($Ax)."\n";
	echo 'Ay[] = '.json_encode($Ay)."\n";

$scale = 1000/($ymax-$ymin);
}

// determine control points
$Bx = array();
$By = array();
for ($i=0; $i<$m; $i++) {

	$Bx[$i] = $Ax[$i]* 1.000000000000
		+$Ax[($i+1)%$m]* 0.267942583732+$Ax[($i+2)%$m]*-0.071770334928+$Ax[($i+3)%$m]* 0.019138755981+$Ax[($i+4)%$m]*-0.004784688995
		+$Ax[($i-4+$m)%$m]* 0.004784688995+$Ax[($i-3+$m)%$m]*-0.019138755981+$Ax[($i-2+$m)%$m]* 0.071770334928+$Ax[($i-1+$m)%$m]*-0.267942583732;
	$By[$i] = $Ay[$i]* 1.000000000000
		+$Ay[($i+1)%$m]* 0.267942583732+$Ay[($i+2)%$m]*-0.071770334928+$Ay[($i+3)%$m]* 0.019138755981+$Ay[($i+4)%$m]*-0.004784688995
		+$Ay[($i-4+$m)%$m]* 0.004784688995+$Ay[($i-3+$m)%$m]*-0.019138755981+$Ay[($i-2+$m)%$m]* 0.071770334928+$Ay[($i-1+$m)%$m]*-0.267942583732;
}
$Cx = array();
$Cy = array();
for ($i=0; $i<$m; $i++) {
	$Cx[$i] = 2*$Ax[($i+1)%$m] - $Bx[($i+1)%$m];
	$Cy[$i] = 2*$Ay[($i+1)%$m] - $By[($i+1)%$m];
}

// walk the path to determine boundingbox (and $summax)
$xmin = $xmax = $Ax[0];
$ymin = $ymax = $Ay[0];
$d=1000; $xofs=0; $yofs=0;
$summax = 0;
for ($k=0; $k<$m; $k++) {

	$x0 = $Ax[$k];
	$y0 = $Ay[$k];
	$x1 = $Bx[$k];
	$y1 = $By[$k];
	$x2 = $Cx[$k];
	$y2 = $Cy[$k];
	$x3 = $Ax[($k+1)%$m];
	$y3 = $Ay[($k+1)%$m];

	$n = $maxslice;
	$lastx = $x0;
	$lasty = $y0;
	for ($i = 1; $i < $n; $i++) {
		$t = $i / $n;
		$t1 = 1 - $t;

		$ex = $x0+($x1-$x0)*$t;
		$ey = $y0+($y1-$y0)*$t;
		$fx = $x1+($x2-$x1)*$t;
		$fy = $y1+($y2-$y1)*$t;
		$gx = $x2+($x3-$x2)*$t;
		$gy = $y2+($y3-$y2)*$t;

		$hx = $ex+($fx-$ex)*$t;
		$hy = $ey+($fy-$ey)*$t;
		$ix = $fx+($gx-$fx)*$t;
		$iy = $fy+($gy-$fy)*$t;

		$x = $hx+($ix-$hx)*$t;
		$y = $hy+($iy-$hy)*$t;

		if ($x < $xmin) $xmin = $x; else if ($x > $xmax) $xmax = $x;
		if ($y < $ymin) $ymin = $y; else if ($y > $ymax) $ymax = $y;

//		if (abs($y-500) < $d && $x > $xofs) {
//			$d = abs($y-500);
//			$xofs = $x;
//		}
		if ($x > $xofs) {
			$xofs = $x;
			$yofs = $y;
		}

		$lastx -= $x;
		$lasty -= $y;
		$summax += sqrt($lastx*$lastx+$lasty*$lasty);
		$lastx = $x;
		$lasty = $y;

	}	
}
echo "$xmin $xmax $ymin $ymax | $xofs $yofs\n";

//--- endInit

for ($outer=0; $outer<3; $outer++) 
for ($loop=0; $loop<60; $loop++) {

echo "$outer.$loop\n";

// storage for gradient lines
$gx0 = array();
$gy0 = array();
$gx1 = array();
$gy1 = array();

	foreach ($_x as $i => $v) {

		imagearc($im, $_x[$i]*$scale,$_y[$i]*$scale, 4,4, 0,360, rgb($_c[$i], ($_v[$i]*$_v[$i])/($v0*$v0)));
		$_x[$i] += $_dx[$i]*$_v[$i];
		$_y[$i] += $_dy[$i]*$_v[$i];
		$_v[$i] -= $a0;
		$_a[$i] -= 0.1;
		if ($_v[$i] < 0) $_v[$i] = 0;
		if ($_a[$i] < 0) $_a[$i] = 0;
	}

// plot bezier

$sum = 0;

for ($k=0; $k<$m; $k++) {

	$x0 = $Ax[$k];
	$y0 = $Ay[$k];
	$x1 = $Bx[$k];
	$y1 = $By[$k];
	$x2 = $Cx[$k];
	$y2 = $Cy[$k];
	$x3 = $Ax[($k+1)%$m];
	$y3 = $Ay[($k+1)%$m];

	$n = $maxslice;

	$lastx = $x0;
	$lasty = $y0;
	for ($i = 1; $i < $n; $i++) {
		$t = $i / $n;
		$t1 = 1 - $t;

/*
		$a = $t1*$t1;
		$d = $t*$t;
		$b = $t*$a*3;
		$c = $t1*$d*3;
		$a *= $t1;
		$d *= $t;

		$x = $a*$x0 + $b*$x1 + $c*$x2 + $d*$x3;
		$y = $a*$y0 + $b*$y1 + $c*$y2 + $d*$y3;
		$lastx -= $x;
		$lasty -= $y;

		$sum += sqrt($lastx*$lastx+$lasty*$lasty);

		$lastx = $x;
		$lasty = $y;
*/

		$ex = $x0+($x1-$x0)*$t;
		$ey = $y0+($y1-$y0)*$t;
		$fx = $x1+($x2-$x1)*$t;
		$fy = $y1+($y2-$y1)*$t;
		$gx = $x2+($x3-$x2)*$t;
		$gy = $y2+($y3-$y2)*$t;

		$hx = $ex+($fx-$ex)*$t;
		$hy = $ey+($fy-$ey)*$t;
		$ix = $fx+($gx-$fx)*$t;
		$iy = $fy+($gy-$fy)*$t;

		$x = $hx+($ix-$hx)*$t;
		$y = $hy+($iy-$hy)*$t;

		imagesetpixel($im, $x*$scale, $y*$scale, $black);
		$gx0[] = $x;
		$gy0[] = $y;

		$lastx -= $x;
		$lasty -= $y;
		$sum += sqrt($lastx*$lastx+$lasty*$lasty);
		$lastx = $x;
		$lasty = $y;


		$dx = $ix-$hx;
		$dy = $iy-$hy;

		$w = (1+sin(2*M_PI*$loop/60+6*2*M_PI*$sum/$summax))*.5*($wmax-$wmin)+$wmin;

		$xx = $x - $dy*$w/sqrt($dx*$dx+$dy*$dy);
		$yy = $y + $dx*$w/sqrt($dx*$dx+$dy*$dy);

if(1)
		imagesetpixel($im, $xx*$scale, $yy*$scale, $green);
		$gx1[] = $xx;
		$gy1[] = $yy;

if (1) {
		$_x[] = $xx;
		$_y[] = $yy;
		$_dx[] = $dx;
		$_dy[] = $dy;
		$_a[] = 0.9;
		$_v[] = $v0;
		$_c[] = $sum/$summax+$loop/60.0;
}
	}

}
printf("summax:%f\n", $sum);

if(1)
	for ($y=0; $y<1000; $y++) {
		for ($x=0; $x<792; $x++) {
			$c = imagecolorat($im0,$x,$y);
			if (($c>>24) != 0)
				imagesetpixel($im, $x, $y, $transp);
		}
	}

imagepng($im, sprintf($argv[2], $loop));

}
