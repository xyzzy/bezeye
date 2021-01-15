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
    die ('usage: '.$argv[0]. ' <wingFileTemplate> <animFileTemplate>'."\n");

	$imw = 1280;
	$imh =  720;
	$maxframe = 120;
	$scale = $imw / 720;

	$wingL = json_decode('[{"x":-92,"y":-354},{"x":-1,"y":-69},{"x":-21,"y":270},{"x":-130,"y":400},{"x":-415,"y":495},{"x":-647,"y":237},{"x":-464,"y":51},{"x":-743,"y":-137},{"x":-716,"y":-383},{"x":-406,"y":-496}]');
	$wingLhotx = 789;
	$wingLhoty = 498;
	$wingLmaxx = 790;
	$wingLmaxy = 1000;

	$wingLx = array();
	$wingLy = array();
	foreach ($wingL as $xy) {
		$wingLx[] = $xy->x;
		$wingLy[] = $xy->y;
	}

$initialPos = '[{"x":234,"y":172.60000000000002},{"x":360,"y":202.3},{"x":494.79999999999995,"y":140.2},{"x":578,"y":109},{"x":583,"y":366.1},{"x":510.5,"y":372.2},{"x":424.79999999999995,"y":324.9},{"x":267,"y":324},{"x":161.5999999999999,"y":363.6},{"x":128.0999999999999,"y":346.29999999999995},{"x":110,"y":277.4},{"x":128,"y":108}]';
$initialSize = '[{"x":20,"y":28.6},{"x":77,"y":15.5},{"x":133,"y":32.7},{"x":190,"y":55},{"x":247,"y":53.1},{"x":303,"y":52.6},{"x":360,"y":59.5},{"x":417,"y":85},{"x":473,"y":67.5},{"x":530,"y":65.1},{"x":587,"y":69},{"x":643,"y":65}]';
$initialRotate = '[{"x":20,"y":42.2},{"x":77,"y":41.8},{"x":133,"y":37.2},{"x":190,"y":22.88},{"x":247,"y":43.9},{"x":303,"y":39.6},{"x":360,"y":33.5},{"x":417,"y":41.76},{"x":473,"y":34.8},{"x":530,"y":33.6},{"x":587,"y":35.2},{"x":643,"y":40}]';
$initialWingSize = '[{"x":20,"y":43.2},{"x":77,"y":43.2},{"x":133,"y":43.2},{"x":190,"y":43.2},{"x":247,"y":43.2},{"x":303,"y":43.2},{"x":360,"y":43.2},{"x":417,"y":43.2},{"x":473,"y":43.2},{"x":530,"y":43.2},{"x":587,"y":43.2},{"x":643,"y":43.2}]';
$initialWingWidth = '[{"x":20,"y":49.6},{"x":77,"y":50},{"x":133,"y":48.2},{"x":190,"y":43.2},{"x":247,"y":43.5},{"x":303,"y":43.6},{"x":360,"y":43.4},{"x":417,"y":43.2},{"x":473,"y":43.1},{"x":530,"y":43.1},{"x":587,"y":42.8},{"x":643,"y":43.2}]';
$initialFlap = '[{"x":20,"y":34.6},{"x":77,"y":32.4},{"x":133,"y":35.1},{"x":190,"y":47},{"x":247,"y":36.2},{"x":303,"y":39.5},{"x":360,"y":44},{"x":417,"y":36},{"x":473,"y":20.1},{"x":530,"y":19.5},{"x":587,"y":24.6},{"x":643,"y":40.32}]';
$initialIrisSize = '[{"x":20,"y":18.8},{"x":77,"y":18},{"x":133,"y":21.6},{"x":190,"y":31.68},{"x":247,"y":31.3},{"x":303,"y":31.2},{"x":360,"y":31.4},{"x":417,"y":30.68},{"x":473,"y":31.8},{"x":530,"y":32},{"x":587,"y":32.4},{"x":643,"y":31.68}]';
$initialUlid = '[{"x":20,"y":13.4},{"x":77,"y":12.7},{"x":133,"y":14.6},{"x":190,"y":22.04},{"x":247,"y":59.5},{"x":303,"y":36.4},{"x":360,"y":27.2},{"x":417,"y":20.88},{"x":473,"y":46.200000000000045},{"x":530,"y":33.9},{"x":587,"y":21.7},{"x":643,"y":32.039999999999964}]';
$initialDlid = '[{"x":20,"y":58.5},{"x":77,"y":58.7},{"x":133,"y":56.3},{"x":190,"y":48.96},{"x":247,"y":18.200000000000045},{"x":303,"y":40.9},{"x":360,"y":47.8},{"x":417,"y":42.92},{"x":473,"y":28},{"x":530,"y":42.2},{"x":587,"y":51.2},{"x":643,"y":42.960000000000036}]';

	$initialPos = json_decode($initialPos);
	$initialSize = json_decode($initialSize);
	$initialRotate = json_decode($initialRotate);
	$initialWingSize = json_decode($initialWingSize);
	$initialWingWidth = json_decode($initialWingWidth);
	$initialFlap = json_decode($initialFlap);
	$initialIrisSize = json_decode($initialIrisSize);
	$initialUlid = json_decode($initialUlid);
	$initialDlid = json_decode($initialDlid);


	$wrapx = 587-20;

	$initialPosx = array();
	$initialPosy = array();
	foreach ($initialPos as $xy) {
		$initialPosx[] = $xy->x * $scale;
		$initialPosy[] = $xy->y * $scale;
	}
	$initialSizex = array();
	$initialSizey = array();
	foreach ($initialSize as $xy) {
		$initialSizex[] = $xy->x;
		$initialSizey[] = $xy->y;
	}
	$initialRotatex = array();
	$initialRotatey = array();
	foreach ($initialRotate as $xy) {
		$initialRotatex[] = $xy->x;
		$initialRotatey[] = $xy->y;
	}
	$initialWingSizex = array();
	$initialWingSizey = array();
	foreach ($initialWingSize as $xy) {
		$initialWingSizex[] = $xy->x;
		$initialWingSizey[] = $xy->y;
	}
	$initialWingWidthx = array();
	$initialWingWidthy = array();
	foreach ($initialWingWidth as $xy) {
		$initialWingWidthx[] = $xy->x;
		$initialWingWidthy[] = $xy->y;
	}
	$initialFlapx = array();
	$initialFlapy = array();
	foreach ($initialFlap as $xy) {
		$initialFlapx[] = $xy->x;
		$initialFlapy[] = $xy->y;
	}
	$initialIrisSizex = array();
	$initialIrisSizey = array();
	foreach ($initialIrisSize as $xy) {
		$initialIrisSizex[] = $xy->x;
		$initialIrisSizey[] = $xy->y;
	}
	$initialUlidx = array();
	$initialUlidy = array();
	foreach ($initialUlid as $xy) {
		$initialUlidx[] = $xy->x;
		$initialUlidy[] = $xy->y;
	}
	$initialDlidx = array();
	$initialDlidy = array();
	foreach ($initialDlid as $xy) {
		$initialDlidx[] = $xy->x;
		$initialDlidy[] = $xy->y;
	}

	function calcControls($A, &$B, &$C)
	{
		$N = count($A);

		if ($N == 3) {

			for ($j=0; $j<3; $j++)
				$B[$j] = $A[$j]* 1.000000000000
			 	       +$A[($j+1)%$N]* 0.333333333333
			 	       +$A[($j+2)%$N]*-0.333333333333;

		} else if ($N == 4) {

			for ($j=0; $j<4; $j++)
				$B[$j] = $A[$j]* 1.000000000000
			 	       +$A[($j+1)%$N]* 0.250000000000+$A[($j+2)%$N]* 0.000000000000
			 	       +$A[($j+3)%$N]*-0.250000000000;

		} else if ($N == 5) {

			for ($j=0; $j<5; $j++)
				$B[$j] = $A[$j]* 1.000000000000
			 	       +$A[($j+1)%$N]* 0.272727272727+$A[($j+2)%$N]*-0.090909090909
			 	       +$A[($j+3)%$N]* 0.090909090909+$A[($j+4)%$N]*-0.272727272727;

		} else if ($N == 6) {

			for ($j=0; $j<6; $j++)
				$B[$j] = $A[$j]* 1.000000000000
			 	       +$A[($j+1)%$N]* 0.266666666667+$A[($j+2)%$N]*-0.066666666667+$A[($j+3)%$N]* 0.000000000000
			 	       +$A[($j+4)%$N]* 0.066666666667+$A[($j+5)%$N]*-0.266666666667;

		} else if ($N == 7) {

			for ($j=0; $j<7; $j++)
				$B[$j] = $A[$j]* 1.000000000000
			 	       +$A[($j+1)%$N]* 0.268292682927+$A[($j+2)%$N]*-0.073170731707+$A[($j+3)%$N]* 0.024390243902
			 	       +$A[($j+4)%$N]*-0.024390243902+$A[($j+5)%$N]* 0.073170731707+$A[($j+6)%$N]*-0.268292682927;
		} else if ($N == 8) {

			for ($j=0; $j<8; $j++)
				$B[$j] = $A[$j]* 1.000000000000
			 	       +$A[($j+1)%$N]* 0.267857142857+$A[($j+2)%$N]*-0.071428571429+$A[($j+3)%$N]* 0.017857142857+$A[($j+4)%$N]*-0.000000000000
			 	       +$A[($j+5)%$N]*-0.017857142857+$A[($j+6)%$N]* 0.071428571429+$A[($j+7)%$N]*-0.267857142857;

		} else if ($N == 9) {

			for ($j=0; $j<9; $j++)
				$B[$j] = $A[$j]* 1.000000000000
			 	       +$A[($j+1)%$N]* 0.267973856209+$A[($j+2)%$N]*-0.071895424837+$A[($j+3)%$N]* 0.019607843137+$A[($j+4)%$N]*-0.006535947712
			 	       +$A[($j+5)%$N]* 0.006535947712+$A[($j+6)%$N]*-0.019607843137+$A[($j+7)%$N]* 0.071895424837+$A[($j+8)%$N]*-0.267973856209;

		} else if ($N == 10) {

			for ($j=0; $j<10; $j++)
				$B[$j] = $A[$j]* 1.000000000000
			 	       +$A[($j+1)%$N]* 0.267942583732+$A[($j+2)%$N]*-0.071770334928+$A[($j+3)%$N]* 0.019138755981+$A[($j+4)%$N]*-0.004784688995+$A[($j+5)%$N]* 0.000000000000
			 	       +$A[($j+6)%$N]* 0.004784688995+$A[($j+7)%$N]*-0.019138755981+$A[($j+8)%$N]* 0.071770334928+$A[($j+9)%$N]*-0.267942583732;

		} else if ($N&1) {

			for ($j=0; $j<$N; $j++)
				$B[$j] = $A[$j]* 1.000000000000
			 	       +$A[($j+1)%$N]* 0.267973856209+$A[($j+2)%$N]*-0.071895424837+$A[($j+3)%$N]* 0.019607843137+$A[($j+4)%$N]*-0.006535947712
			 	       +$A[($j-4+$N)%$N]* 0.006535947712+$A[($j-3+$N)%$N]*-0.019607843137+$A[($j-2+$N)%$N]* 0.071895424837+$A[($j-1+$N)%$N]*-0.267973856209;

		} else {

			for ($j=0; $j<$N; $j++)
				$B[$j] = $A[$j]* 1.000000000000
			 	 	      +$A[($j+1)%$N]* 0.267942583732+$A[($j+2)%$N]*-0.071770334928+$A[($j+3)%$N]* 0.019138755981+$A[($j+4)%$N]*-0.004784688995
			 	 	      +$A[($j-4+$N)%$N]* 0.004784688995+$A[($j-3+$N)%$N]*-0.019138755981+$A[($j-2+$N)%$N]* 0.071770334928+$A[($j-1+$N)%$N]*-0.267942583732;

		}

		for ($j=0; $j<$N; $j++) {
			$C[$j] = 2*$A[($j+1)%$N] - $B[($j+1)%$N];
		}
	}

	function calcControlsOpen($A, &$B, &$C, $wrap)
	{
		$N = count($A);
		$W = array();

		for ($i=0; $i<$N; $i++)
			$W[] = $A[$i] - $wrap;
		for ($i=0; $i<$N; $i++)
			$W[] = $A[$i];
		for ($i=0; $i<$N; $i++)
			$W[] = $A[$i] + $wrap;

		if ($N == 3) {

			for ($j=0; $j<3; $j++)
				$B[$j] = $W[$N+$j]* 1.000000000000
				 	       +$W[$N+($j+1)]* 0.333333333333
				 	       +$W[$N+($j-1)]*-0.333333333333;

		} else if ($N == 4) {

			for ($j=0; $j<4; $j++)
				$B[$j] = $W[$N+$j]* 1.000000000000
				 	       +$W[$N+($j+1)]* 0.250000000000+$W[$N+($j+2)]* 0.000000000000
				 	       +$W[$N+($j-1)]*-0.250000000000;

		} else if ($N == 5) {

			for ($j=0; $j<5; $j++)
				$B[$j] = $W[$N+$j]* 1.000000000000
				 	       +$W[$N+($j+1)]* 0.272727272727+$W[$N+($j+2)]*-0.090909090909
				 	       +$W[$N+($j-2)]* 0.090909090909+$W[$N+($j-1)]*-0.272727272727;
	
		} else if ($N == 6) {

			for ($j=0; $j<6; $j++)
				$B[$j] = $W[$N+$j]* 1.000000000000
				 	       +$W[$N+($j+1)]* 0.266666666667+$W[$N+($j+2)]*-0.066666666667+$W[$N+($j+3)]* 0.000000000000
				 	       +$W[$N+($j-2)]* 0.066666666667+$W[$N+($j-1)]*-0.266666666667;

		} else if ($N == 7) {

			for ($j=0; $j<7; $j++)
				$B[$j] = $W[$N+$j]* 1.000000000000
				 	       +$W[$N+($j+1)]* 0.268292682927+$W[$N+($j+2)]*-0.073170731707+$W[$N+($j+3)]* 0.024390243902
				 	       +$W[$N+($j-3)]*-0.024390243902+$W[$N+($j-2)]* 0.073170731707+$W[$N+($j-1)]*-0.268292682927;

		} else if ($N == 8) {

			for ($j=0; $j<8; $j++)
				$B[$j] = $W[$N+$j]* 1.000000000000
				 	       +$W[$N+($j+1)]* 0.267857142857+$W[$N+($j+2)]*-0.071428571429+$W[$N+($j+3)]* 0.017857142857+$W[$N+($j+4)]*-0.000000000000
				 	       +$W[$N+($j-3)]*-0.017857142857+$W[$N+($j-2)]* 0.071428571429+$W[$N+($j-1)]*-0.267857142857;

		} else if ($N == 9) {

			for ($j=0; $j<9; $j++)
				$B[$j] = $W[$N+$j]* 1.000000000000
				 	       +$W[$N+($j+1)]* 0.267973856209+$W[$N+($j+2)]*-0.071895424837+$W[$N+($j+3)]* 0.019607843137+$W[$N+($j+4)]*-0.006535947712
				 	       +$W[$N+($j-4)]* 0.006535947712+$W[$N+($j-3)]*-0.019607843137+$W[$N+($j-2)]* 0.071895424837+$W[$N+($j-1)]*-0.267973856209;

		} else if ($N == 10) {

			for ($j=0; $j<10; $j++)
				$B[$j] = $W[$N+$j]* 1.000000000000
				 	       +$W[$N+($j+1)]* 0.267942583732+$W[$N+($j+2)]*-0.071770334928+$W[$N+($j+3)]* 0.019138755981+$W[$N+($j+4)]*-0.004784688995+$W[$N+($j+5)]* 0.000000000000
				 	       +$W[$N+($j-4)]* 0.004784688995+$W[$N+($j-3)]*-0.019138755981+$W[$N+($j-2)]* 0.071770334928+$W[$N+($j-1)]*-0.267942583732;

		} else if ($N&1) {

			for ($j=0; $j<$N; $j++)
				$B[$j] = $W[$N+$j]* 1.000000000000
				 	       +$W[$N+($j+1)]* 0.267973856209+$W[$N+($j+2)]*-0.071895424837+$W[$N+($j+3)]* 0.019607843137+$W[$N+($j+4)]*-0.006535947712
				 	       +$W[$N+($j-4)]* 0.006535947712+$W[$N+($j-3)]*-0.019607843137+$W[$N+($j-2)]* 0.071895424837+$W[$N+($j-1)]*-0.267973856209;

		} else {

			for ($j=0; $j<$N; $j++)
				$B[$j] = $W[$N+$j]* 1.000000000000
				 	 	      +$W[$N+($j+1)]* 0.267942583732+$W[$N+($j+2)]*-0.071770334928+$W[$N+($j+3)]* 0.019138755981+$W[$N+($j+4)]*-0.004784688995
				 	 	      +$W[$N+($j-4)]* 0.004784688995+$W[$N+($j-3)]*-0.019138755981+$W[$N+($j-2)]* 0.071770334928+$W[$N+($j-1)]*-0.267942583732;

		}

		for ($j=0; $j<$N-1; $j++) {
			$C[$j] = 2*$A[$j+1] - $B[$j+1];
		}
		$C[$N-1] = 2*$W[$N] - $B[0]+$wrap;
	}

	function getv($t, &$Ay)
	{
		global $wrapx;

		$t += 1;
		$t = $t - floor($t);

		$m = count($Ay);
		$n = floor($m * $t);
		$t = $m*$t - $n;
		$t1 = (1-$t);

		$By = array();
		$Cy = array();
		calcControlsOpen($Ay, $By, $Cy, 0);

		$y = $Ay[($n+1)%$m]*$t*$t*$t+ $Cy[$n]*$t*$t*$t1*3 + $By[$n]*$t*$t1*$t1*3 + $Ay[$n]*$t1*$t1*$t1;

		return $y;
	}
	function size_getv($t)
	{
		$y = getv($t, $GLOBALS['initialSizey']);

		$ymin = 100-10;
		$ymax = 10;
		$vmin = 4;
		$vmax = 200;

		$y =($y-$ymin)/($ymax-$ymin);
		$y = ($vmax-$vmin)*$y+$vmin;

		return $y * $GLOBALS['scale'];
	}
	function irissize_getv($t)
	{
		$y = getv($t, $GLOBALS['initialIrisSizey']);

		$ymin = 72-10;
		$ymax = 10;
		$vmin = 0.1;
		$vmax = 1.0;

		$y =($y-$ymin)/($ymax-$ymin);
		$y = ($vmax-$vmin)*$y+$vmin;

		return $y;
	}
	function wingsize_getv($t)
	{
		$y = getv($t, $GLOBALS['initialWingSizey']);

		$ymin = 72-10;
		$ymax = 10;
		$vmin = 0.5;
		$vmax = 2.0;

		$y =($y-$ymin)/($ymax-$ymin);
		$y = ($vmax-$vmin)*$y+$vmin;

		return $y;
	}
	function wingwidth_getv($t)
	{
		$y = getv($t, $GLOBALS['initialWingWidthy']);

		$ymin = 72-10;
		$ymax = 10;
		$vmin = 0.1;
		$vmax = 1.9;

		$y =($y-$ymin)/($ymax-$ymin);
		$y = ($vmax-$vmin)*$y+$vmin;

		return $y;
	}
	function flap_getv($t)
	{
		$y = getv($t, $GLOBALS['initialFlapy']);

		$ymin = 72-10;
		$ymax = 10;
		$vmin = -1;
		$vmax = +1;

		$y =($y-$ymin)/($ymax-$ymin);
		$y = ($vmax-$vmin)*$y+$vmin;

		return $y;
	}
	function rotate_getv($t)
	{
		$y = getv($t, $GLOBALS['initialRotatey']);

		$ymin = 72-10;
		$ymax = 10;
		$vmin = -60;
		$vmax = +60;

		$y =($y-$ymin)/($ymax-$ymin);
		$y = ($vmax-$vmin)*$y+$vmin;

		return $y;
	}
	function ulid_getv($t)
	{
		$y = getv($t, $GLOBALS['initialUlidy']);

		$ymin = 72-10;
		$ymax = 10;
		$vmin = 0;
		$vmax = 1;

		$y =($y-$ymin)/($ymax-$ymin);
		$y = ($vmax-$vmin)*$y+$vmin;

		return $y;
	}
	function dlid_getv($t)
	{
		$y = getv($t, $GLOBALS['initialDlidy']);

		$ymin = 72-10;
		$ymax = 10;
		$vmin = 0;
		$vmax = 1;

		$y =($y-$ymin)/($ymax-$ymin);
		$y = ($vmax-$vmin)*$y+$vmin;

		return $y;
	}

	function rgb($ang)
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

		return imagecolorallocate($im, $r*255,$g*255,$b*255);
	}

	function render($z, $t)
	{
		global $imw, $imh, $im, $maxslice;
		global $black, $white, $gray, $gray25, $gray50, $gray75, $gray90;
		global $wingLx, $wingLy, $wingLhotx, $wingLhoty, $wingLmaxx, $wingLmaxy;
		global $texture, $gT;

		$t += 1;
		$t = $t - floor($t);

		// get centerxy
		$Ax = $GLOBALS['initialPosx'];
		$Bx = array();
		$Cx = array();
		calcControls($Ax,$Bx,$Cx);

		$Ay = $GLOBALS['initialPosy'];
		$By = array();
		$Cy = array();
		calcControls($Ay,$By,$Cy);

		// guideline path
		$m = count($Ax);
		$n = floor($m * $t);
		$t0 = $m*$t - $n;
		$t1 = (1-$t0);

		$x0 = $Ax[($n+1)%$m]*$t0*$t0*$t0+ $Cx[$n]*$t0*$t0*$t1*3 + $Bx[$n]*$t0*$t1*$t1*3 + $Ax[$n]*$t1*$t1*$t1;
		$y0 = $Ay[($n+1)%$m]*$t0*$t0*$t0+ $Cy[$n]*$t0*$t0*$t1*3 + $By[$n]*$t0*$t1*$t1*3 + $Ay[$n]*$t1*$t1*$t1;

		$eyesize = size_getv($t);
		$irissize = irissize_getv($t);
		$wingsize = wingsize_getv($t);
		$wingwidth = wingwidth_getv($t);
		$flap = flap_getv($t);
		$rotate = rotate_getv($t);
		$ulid = ulid_getv($t);
		$dlid = dlid_getv($t);

$eyesize = round($eyesize);

// echo "eyesize:$eyesize irissize:$irissize wingsize:$wingsize wingwidth:$wingwidth flap:$flap rotate:$rotate\n";

		/*
		** Left wing
		*/
		$affine1 = array( $eyesize*2/$wingLmaxx, 0, 0, $eyesize*2/$wingLmaxy, 0, 0); // scale from texture to wing
		$affine2 = array( $wingsize*$wingwidth, 0, 0, $wingsize, 0, 0 ); // scale
		$affine3 = array( 1, $flap,0,1,0,0 ); // skew
		$affine4 = array( cos(-$rotate*2*M_PI/360), sin(-$rotate*2*M_PI/360), -sin(-$rotate*2*M_PI/360), cos(-$rotate*2*M_PI/360), 0, 0 ); // rotate

		$wingLAx = array();
		$wingLAy = array();


//echo json_encode($wingLx)."\n";

		// L wing
		$dx = -cos($rotate*2*M_PI/360)*$eyesize;
		$dy = +sin($rotate*2*M_PI/360)*$eyesize;
		for ($j=0; $j<count($wingLx); $j++) {

			$x = $wingLx[$j];
			$y = $wingLy[$j];
			$x2 = $x*$affine1[0] + $y*$affine1[2] + $affine1[4];
			$y2 = $x*$affine1[1] + $y*$affine1[3] + $affine1[5];
			$x = $x2;
			$y = $y2;
			$x2 = $x*$affine2[0] + $y*$affine2[2] + $affine2[4];
			$y2 = $x*$affine2[1] + $y*$affine2[3] + $affine2[5];
			$x = $x2;
			$y = $y2;
			$x2 = $x*$affine3[0] + $y*$affine3[2] + $affine3[4];
			$y2 = $x*$affine3[1] + $y*$affine3[3] + $affine3[5];
			$x = $x2;
			$y = $y2;
			$x2 = $x*$affine4[0] + $y*$affine4[2] + $affine4[4];
			$y2 = $x*$affine4[1] + $y*$affine4[3] + $affine4[5];
			$x = $x2;
			$y = $y2;

			$wingLAx[$j] = $x0+$dx+$x;
			$wingLAy[$j] = $y0+$dy+$y;
		}
		$wingLBx = array();
		$wingLBy = array();
		$wingLCx = array();
		$wingLCy = array();
		calcControls($wingLAx, $wingLBx, $wingLCx);
		calcControls($wingLAy, $wingLBy, $wingLCy);

// echo json_encode($wingLAx)."\n";

		// draw outline and determine bounding box
		$bbxmin = $wingLAx[0];
		$bbxmax = $wingLAx[0];
		$bbymin = $wingLAy[0];
		$bbymax = $wingLAy[0];
		$m = count($wingLAx);
		for ($k=0; $k<$m; $k++) {
			for ($i = 1; $i < $maxslice; $i++) {
				$t = $i / $maxslice;
				$t1 = 1 - $t;

				$x = $wingLAx[$k]*$t1*$t1*$t1 + $wingLBx[$k]*$t*$t1*$t1*3 + $wingLCx[$k]*$t*$t*$t1*3 + $wingLAx[($k+1)%$m]*$t*$t*$t;
				$y = $wingLAy[$k]*$t1*$t1*$t1 + $wingLBy[$k]*$t*$t1*$t1*3 + $wingLCy[$k]*$t*$t*$t1*3 + $wingLAy[($k+1)%$m]*$t*$t*$t;
				imagesetpixel($im, $x, $y, $black);

				if ($x < $bbxmin) $bbxmin = $x; else if ($x > $bbxmax) $bbxmax = $x;
				if ($y < $bbymin) $bbymin = $y; else if ($y > $bbymax) $bbymax = $y;
			}
		}
// echo "$bbxmin $bbymin $bbxmax $bbymax\n";

		// determine inverse affine
		$det = $affine1[0]*$affine1[3] - $affine1[1]*$affine1[2];
		$isx =  $affine1[3]/$det;
		$irx = -$affine1[1]/$det;
		$iry = -$affine1[2]/$det;
		$isy =  $affine1[0]/$det;
		$itx = -$affine1[4]*$isx - $affine1[5]*$iry;
		$ity = -$affine1[4]*$irx - $affine1[5]*$isy;
		$iaffine1 = array( $isx, $irx, $iry, $isy, $itx, $ity);

		// determine inverse affine
		$det = $affine2[0]*$affine2[3] - $affine2[1]*$affine2[2];
		$isx =  $affine2[3]/$det;
		$irx = -$affine2[1]/$det;
		$iry = -$affine2[2]/$det;
		$isy =  $affine2[0]/$det;
		$itx = -$affine2[4]*$isx - $affine2[5]*$iry;
		$ity = -$affine2[4]*$irx - $affine2[5]*$isy;
		$iaffine2 = array( $isx, $irx, $iry, $isy, $itx, $ity);

		// determine inverse affine
		$det = $affine3[0]*$affine3[3] - $affine3[1]*$affine3[2];
		$isx =  $affine3[3]/$det;
		$irx = -$affine3[1]/$det;
		$iry = -$affine3[2]/$det;
		$isy =  $affine3[0]/$det;
		$itx = -$affine3[4]*$isx - $affine3[5]*$iry;
		$ity = -$affine3[4]*$irx - $affine3[5]*$isy;
		$iaffine3 = array( $isx, $irx, $iry, $isy, $itx, $ity);

		// determine inverse affine
		$det = $affine4[0]*$affine4[3] - $affine4[1]*$affine4[2];
		$isx =  $affine4[3]/$det;
		$irx = -$affine4[1]/$det;
		$iry = -$affine4[2]/$det;
		$isy =  $affine4[0]/$det;
		$itx = -$affine4[4]*$isx - $affine4[5]*$iry;
		$ity = -$affine4[4]*$irx - $affine4[5]*$isy;
		$iaffine4 = array( $isx, $irx, $iry, $isy, $itx, $ity);

		// scan the bounding box
		for ($y=$bbymin; $y<$bbymax; $y++) {
		if ($y<0||$y>=$imh) continue;
		for ($x=$bbxmin; $x<$bbxmax; $x++) {
			if ($x<0||$x>=$imw) continue;

			// inverse transform to texture coordinates
			$x1 = $x-$x0-$dx;
			$y1 = $y-$y0-$dy;
			$x2 = $x1*$iaffine4[0] + $y1*$iaffine4[2] + $iaffine4[4];
			$y2 = $x1*$iaffine4[1] + $y1*$iaffine4[3] + $iaffine4[5];
			$x1 = $x2;
			$y1 = $y2;
			$x2 = $x1*$iaffine3[0] + $y1*$iaffine3[2] + $iaffine3[4];
			$y2 = $x1*$iaffine3[1] + $y1*$iaffine3[3] + $iaffine3[5];
			$x1 = $x2;
			$y1 = $y2;
			$x2 = $x1*$iaffine2[0] + $y1*$iaffine2[2] + $iaffine2[4];
			$y2 = $x1*$iaffine2[1] + $y1*$iaffine2[3] + $iaffine2[5];
			$x1 = $x2;
			$y1 = $y2;
			$x2 = $x1*$iaffine1[0] + $y1*$iaffine1[2] + $iaffine1[4];
			$y2 = $x1*$iaffine1[1] + $y1*$iaffine1[3] + $iaffine1[5];
			$x1 = $x2;
			$y1 = $y2;

			// move to texture origin
			$x1 = round($wingLhotx+$x1);
			$y1 = round($wingLhoty+$y1);

			// test if texture transparent
			if ($x1 >= 0 && $x1 < $wingLmaxx && $y1 >= 0 && $y1 < $wingLmaxy) {

				$c = imagecolorat($texture,$x1,$y1);
				if (($c>>24) == 0) {
					// write screen pixel
					imagesetpixel($im, $x, $y, imagecolorallocate($im, ($c>>16)&0xff,($c>>8)&0xff,($c>>0)&0xff));
				}

			}
		}}

		/*
		** Right wing
		*/
		$affine1 = array( -$eyesize*2/$wingLmaxx, 0, 0, $eyesize*2/$wingLmaxy, 0, 0); // scale and flip from texture to wing
		$affine2 = array( $wingsize*$wingwidth, 0, 0, $wingsize, 0, 0 ); // scale
		$affine3 = array( 1, -$flap,0,1,0,0 ); // skew
		$affine4 = array( cos(-$rotate*2*M_PI/360), sin(-$rotate*2*M_PI/360), -sin(-$rotate*2*M_PI/360), cos(-$rotate*2*M_PI/360), 0, 0 ); // rotate

		$wingLAx = array();
		$wingLAy = array();


//echo json_encode($wingLx)."\n";

		// R wing
		$dx =  cos($rotate*2*M_PI/360)*$eyesize;
		$dy = -sin($rotate*2*M_PI/360)*$eyesize;
		for ($j=0; $j<count($wingLx); $j++) {

			$x = $wingLx[$j];
			$y = $wingLy[$j];
			$x2 = $x*$affine1[0] + $y*$affine1[2] + $affine1[4];
			$y2 = $x*$affine1[1] + $y*$affine1[3] + $affine1[5];
			$x = $x2;
			$y = $y2;
			$x2 = $x*$affine2[0] + $y*$affine2[2] + $affine2[4];
			$y2 = $x*$affine2[1] + $y*$affine2[3] + $affine2[5];
			$x = $x2;
			$y = $y2;
			$x2 = $x*$affine3[0] + $y*$affine3[2] + $affine3[4];
			$y2 = $x*$affine3[1] + $y*$affine3[3] + $affine3[5];
			$x = $x2;
			$y = $y2;
			$x2 = $x*$affine4[0] + $y*$affine4[2] + $affine4[4];
			$y2 = $x*$affine4[1] + $y*$affine4[3] + $affine4[5];
			$x = $x2;
			$y = $y2;

			$wingLAx[$j] = $x0+$dx+$x;
			$wingLAy[$j] = $y0+$dy+$y;
		}
		$wingLBx = array();
		$wingLBy = array();
		$wingLCx = array();
		$wingLCy = array();
		calcControls($wingLAx, $wingLBx, $wingLCx);
		calcControls($wingLAy, $wingLBy, $wingLCy);

// echo json_encode($wingLAx)."\n";

		// draw outline and determine bounding box
		$bbxmin = $wingLAx[0];
		$bbxmax = $wingLAx[0];
		$bbymin = $wingLAy[0];
		$bbymax = $wingLAy[0];
		$m = count($wingLAx);
		for ($k=0; $k<$m; $k++) {
			for ($i = 1; $i < $maxslice; $i++) {
				$t = $i / $maxslice;
				$t1 = 1 - $t;

				$x = $wingLAx[$k]*$t1*$t1*$t1 + $wingLBx[$k]*$t*$t1*$t1*3 + $wingLCx[$k]*$t*$t*$t1*3 + $wingLAx[($k+1)%$m]*$t*$t*$t;
				$y = $wingLAy[$k]*$t1*$t1*$t1 + $wingLBy[$k]*$t*$t1*$t1*3 + $wingLCy[$k]*$t*$t*$t1*3 + $wingLAy[($k+1)%$m]*$t*$t*$t;
				imagesetpixel($im, $x, $y, $black);

				if ($x < $bbxmin) $bbxmin = $x; else if ($x > $bbxmax) $bbxmax = $x;
				if ($y < $bbymin) $bbymin = $y; else if ($y > $bbymax) $bbymax = $y;
			}
		}
// echo "$bbxmin $bbymin $bbxmax $bbymax\n";

		// determine inverse affine
		$det = $affine1[0]*$affine1[3] - $affine1[1]*$affine1[2];
		$isx =  $affine1[3]/$det;
		$irx = -$affine1[1]/$det;
		$iry = -$affine1[2]/$det;
		$isy =  $affine1[0]/$det;
		$itx = -$affine1[4]*$isx - $affine1[5]*$iry;
		$ity = -$affine1[4]*$irx - $affine1[5]*$isy;
		$iaffine1 = array( $isx, $irx, $iry, $isy, $itx, $ity);

		// determine inverse affine
		$det = $affine2[0]*$affine2[3] - $affine2[1]*$affine2[2];
		$isx =  $affine2[3]/$det;
		$irx = -$affine2[1]/$det;
		$iry = -$affine2[2]/$det;
		$isy =  $affine2[0]/$det;
		$itx = -$affine2[4]*$isx - $affine2[5]*$iry;
		$ity = -$affine2[4]*$irx - $affine2[5]*$isy;
		$iaffine2 = array( $isx, $irx, $iry, $isy, $itx, $ity);

		// determine inverse affine
		$det = $affine3[0]*$affine3[3] - $affine3[1]*$affine3[2];
		$isx =  $affine3[3]/$det;
		$irx = -$affine3[1]/$det;
		$iry = -$affine3[2]/$det;
		$isy =  $affine3[0]/$det;
		$itx = -$affine3[4]*$isx - $affine3[5]*$iry;
		$ity = -$affine3[4]*$irx - $affine3[5]*$isy;
		$iaffine3 = array( $isx, $irx, $iry, $isy, $itx, $ity);

		// determine inverse affine
		$det = $affine4[0]*$affine4[3] - $affine4[1]*$affine4[2];
		$isx =  $affine4[3]/$det;
		$irx = -$affine4[1]/$det;
		$iry = -$affine4[2]/$det;
		$isy =  $affine4[0]/$det;
		$itx = -$affine4[4]*$isx - $affine4[5]*$iry;
		$ity = -$affine4[4]*$irx - $affine4[5]*$isy;
		$iaffine4 = array( $isx, $irx, $iry, $isy, $itx, $ity);

		// scan the bounding box
		for ($y=$bbymin; $y<$bbymax; $y++) {
		if ($y<0||$y>=$imh) continue;
		for ($x=$bbxmin; $x<$bbxmax; $x++) {
			if ($x<0||$x>=$imw) continue;

			// inverse transform to texture coordinates
			$x1 = $x-$x0-$dx;
			$y1 = $y-$y0-$dy;
			$x2 = $x1*$iaffine4[0] + $y1*$iaffine4[2] + $iaffine4[4];
			$y2 = $x1*$iaffine4[1] + $y1*$iaffine4[3] + $iaffine4[5];
			$x1 = $x2;
			$y1 = $y2;
			$x2 = $x1*$iaffine3[0] + $y1*$iaffine3[2] + $iaffine3[4];
			$y2 = $x1*$iaffine3[1] + $y1*$iaffine3[3] + $iaffine3[5];
			$x1 = $x2;
			$y1 = $y2;
			$x2 = $x1*$iaffine2[0] + $y1*$iaffine2[2] + $iaffine2[4];
			$y2 = $x1*$iaffine2[1] + $y1*$iaffine2[3] + $iaffine2[5];
			$x1 = $x2;
			$y1 = $y2;
			$x2 = $x1*$iaffine1[0] + $y1*$iaffine1[2] + $iaffine1[4];
			$y2 = $x1*$iaffine1[1] + $y1*$iaffine1[3] + $iaffine1[5];
			$x1 = $x2;
			$y1 = $y2;

			// move to texture origin
			$x1 = round($wingLhotx+$x1);
			$y1 = round($wingLhoty+$y1);

			// test if texture transparent
			if ($x1 >= 0 && $x1 < $wingLmaxx && $y1 >= 0 && $y1 < $wingLmaxy) {

				$c = imagecolorat($texture,$x1,$y1);
				if (($c>>24) == 0) {
					// write screen pixel
					imagesetpixel($im, $x, $y, imagecolorallocate($im, ($c>>16)&0xff,($c>>8)&0xff,($c>>0)&0xff));
				}

			}
		}}

		/*
		** Eye lid texture first
		*/
		imagefilledarc($im, $x0, $y0, $eyesize*2, $eyesize*2, 0, 360, $gray50, 0);


		/*
		** Upper lid
		*/
if ($ulid<0) $ulid = 0;
if ($ulid>1) $ulid = 1;
		$lAx = -cos($rotate*2*M_PI/360)*$eyesize; // left
		$lAy =  sin($rotate*2*M_PI/360)*$eyesize;
		$lBx = -sin($rotate*2*M_PI/360)*$eyesize*$ulid; // upper
		$lBy = -cos($rotate*2*M_PI/360)*$eyesize*$ulid;
		$lCx =  cos($rotate*2*M_PI/360)*$eyesize; // right
		$lCy = -sin($rotate*2*M_PI/360)*$eyesize;

//		imagefilledrectangle($im, $x0+$lAx-3,$y0+$lAy-3, $x0+$lAx+3,$y0+$lAy+3, $white);
//		imagefilledrectangle($im, $x0+$lBx-3,$y0+$lBy-3, $x0+$lBx+3,$y0+$lBy+3, $white);
//		imagefilledrectangle($im, $x0+$lCx-3,$y0+$lCy-3, $x0+$lCx+3,$y0+$lCy+3, $white);

		// calc center of arc that touches eye lid
		if ($ulid != 0) { 
			$yDelta_a = $lBy - $lAy;
			$xDelta_a = $lBx - $lAx;
			$yDelta_b = $lCy - $lBy;
			$xDelta_b = $lCx - $lBx;
			$aSlope = $yDelta_a/$xDelta_a;
			$bSlope = $yDelta_b/$xDelta_b;
			$ucx = ($aSlope*$bSlope*($lAy - $lCy) + $bSlope*($lAx + $lBx) - $aSlope*($lBx+$lCx) )/(2* ($bSlope-$aSlope) );
			$ucy = -1*($ucx - ($lAx+$lBx)/2)/$aSlope +  ($lAy+$lBy)/2;
			$ur = sqrt(($ucx-$lAx)*($ucx-$lAx)+($ucy-$lAy)*($ucy-$lAy));
		} else {
			$ucx = 0;
			$ucy = 0;
			$ur = $eyesize;
		}
//		imagefilledrectangle($im, $x0+$ucx-3,$y0+$ucy-3, $x0+$ucx+3,$y0+$ucy+3, $white);


		/*
		** lower lid
		*/
if ($dlid<0) $dlid = 0;
if ($dlid>1) $dlid = 1;
		$lAx = -cos($rotate*2*M_PI/360)*$eyesize; // left
		$lAy =  sin($rotate*2*M_PI/360)*$eyesize;
		$lBx =  sin($rotate*2*M_PI/360)*$eyesize*(1-$dlid); // lower
		$lBy =  cos($rotate*2*M_PI/360)*$eyesize*(1-$dlid);
		$lCx =  cos($rotate*2*M_PI/360)*$eyesize; // right
		$lCy = -sin($rotate*2*M_PI/360)*$eyesize;

		// calc center of arc that touches eye lid
		if (1-$dlid != 0) { 
			$yDelta_a = $lBy - $lAy;
			$xDelta_a = $lBx - $lAx;
			$yDelta_b = $lCy - $lBy;
			$xDelta_b = $lCx - $lBx;
			$aSlope = $yDelta_a/$xDelta_a;
			$bSlope = $yDelta_b/$xDelta_b;
			$dcx = ($aSlope*$bSlope*($lAy - $lCy) + $bSlope*($lAx + $lBx) - $aSlope*($lBx+$lCx) )/(2* ($bSlope-$aSlope) );
			$dcy = -1*($dcx - ($lAx+$lBx)/2)/$aSlope +  ($lAy+$lBy)/2;
			$dr = sqrt(($dcx-$lAx)*($dcx-$lAx)+($dcy-$lAy)*($dcy-$lAy));
		} else {
			$dcx = 0;
			$dcy = 0;
			$dr = $eyesize;
		}
//		imagefilledrectangle($im, $x0+$dcx-3,$y0+$dcy-3, $x0+$dcx+3,$y0+$dcy+3, $white);

		$riris = $eyesize*$irissize;

		// scan bounding box
		for ($y=$y0-$eyesize; $y<$y0+$eyesize; $y++) {
		if ($y<0||$y>=$imh) continue;
		for ($x=$x0-$eyesize; $x<$x0+$eyesize; $x++) {
			if ($x<0||$x>=$imw) continue;

			$edge = 0;

			$dx = $x-($x0+$ucx);
			$dy = $y-($y0+$ucy);
			$dxy = sqrt($dx*$dx+$dy*$dy);
			$r = sqrt($dx*$dx+$dy*$dy);
			if (abs($dxy-$ur) < 2)
				$edge++;
			else if ($dxy > $ur) 
				continue;

			$dx = $x-($x0+$dcx);
			$dy = $y-($y0+$dcy);
			$dxy = sqrt($dx*$dx+$dy*$dy);
			$r = sqrt($dx*$dx+$dy*$dy);
			if (abs($dxy-$dr) < 2)
				$edge++;
			else if ($dxy > $dr)
				continue;


			if ($edge) {
				// eyelid rim
				imagesetpixel($im, $x, $y, $black);
			} else {
				// eye-white
				imagesetpixel($im, $x, $y, $white);

				// iris
				$dx = $x-$x0;
				$dy = $y-$y0;
				$r = sqrt($dx*$dx+$dy*$dy);
				if ($r < $riris) {

					$a = atan2($dy,$dx);

					$a += M_PI;
					$a += pow($r,0.41);
					$a /= 2*M_PI; //scale -0.5 .. +0.5
					$a += 0.5; // transform 0..1
					$a += $gT*3*3;

					imagesetpixel($im, $x, $y, rgb($a));
				}
			}
		}}

return;

/*
		// get size
		var wngsiz = _.wngsiz.getv(t);
		var wngwid = _.wngwid.getv(t);
		var flap = _.flap.getv(t);
		var siz = Math.round(_.size.getv(t));
		var rot = _.rot.getv(t);
		var irissiz = Math.round(siz * _.irissiz.getv(t));
		var x0 = round(_.final.xy[z].x);
		var y0 = round(_.final.xy[z].y);

		var cr = 255*(z==0);
		var cg = 255*(z==1);
		var cb = 255*(z==2);

		// eye-white
		_.ctx.fillStyle = '#ffffff';
		_.ctx.strokeStyle = '#000000';
		_.ctx.lineWidth = 2;
		_.ctx.beginPath();
		_.ctx.arc(x0,y0,siz,0,2*M_PI);
		_.ctx.fill();

*/

		/*
		** Iris
		*/
/*
		// upper lid

		var ulid = _.ulid.getv(t);

		// lower lid

		var dlid = 1-_.dlid.getv(t);
if (dlid<0) dlid = 0;
if (dlid>1) dlid = 1;
		var lAx = -Math.cos(rot*2*M_PI/360)*siz; // left
		var lAy = Math.sin(rot*2*M_PI/360)*siz;
		var lBx = Math.sin(rot*2*M_PI/360)*siz*dlid; // lower
		var lBy = Math.cos(rot*2*M_PI/360)*siz*dlid;
		var lCx = Math.cos(rot*2*M_PI/360)*siz; // right
		var lCy = -Math.sin(rot*2*M_PI/360)*siz;

		_.ctx.fillStyle = '#000000';
		_.ctx.strokeStyle = '#ffffff';
//		_.ctx.fillRect(x0+lAx-3,y0+lAy-3,6,6);
//		_.ctx.fillRect(x0+lBx-3,y0+lBy-3,6,6);
//		_.ctx.fillRect(x0+lCx-3,y0+lCy-3,6,6);

		var yDelta_a = lBy - lAy;
		var xDelta_a = lBx - lAx;
		var yDelta_b = lCy - lBy;
		var xDelta_b = lCx - lBx;
		var aSlope = yDelta_a/xDelta_a;
		var bSlope = yDelta_b/xDelta_b;
		var centerx = (aSlope*bSlope*(lAy - lCy) + bSlope*(lAx + lBx) - aSlope*(lBx+lCx) )/(2* (bSlope-aSlope) );
		var centery = -1*(centerx - (lAx+lBx)/2)/aSlope +  (lAy+lBy)/2;
//		_.ctx.fillRect(x0+centerx-3,y0+centery-3,6,6);

		_.ctx.strokeStyle = '#000000';
		_.ctx.lineWidth = 2;
		_.ctx.beginPath();

		_.ctx.moveTo(x0+lCx, y0+lCy);

		var a2 = Math.atan2(lAy-centery,lAx-centerx);
		var a3 = Math.atan2(lCy-centery,lCx-centerx);
		_.ctx.lineWidth = 3;
		_.ctx.arc(x0+centerx,y0+centery, Math.sqrt((centerx-lAx)*(centerx-lAx)+(centery-lAy)*(centery-lAy)), a2, a3, true);
		var a2 = Math.atan2(lAy-0,lAx-0);
		var a3 = Math.atan2(lCy-0,lCx-0);
		_.ctx.lineWidth = 1;
		_.ctx.arc(x0+0,y0+0, Math.sqrt((0-lAx)*(0-lAx)+(0-lAy)*(0-lAy)), a3, a2);

		_.ctx.closePath();
		_.ctx.fill();
		_.ctx.stroke();
*/
	}

//------------------------
//------------------------

	$maxslice = $imw;
	$im = imagecreatetruecolor($imw,$imh);
	$white = imagecolorallocate($im, 255,255,255);
	$black = imagecolorallocate($im, 0,0,0);
	$green = imagecolorallocate($im, 0,255,0);
	$blue = imagecolorallocate($im, 0,0,255);
	$gray = imagecolorallocate($im, 127,127,127);
	$gray25 = imagecolorallocate($im, 63,63,63);
	$gray50 = imagecolorallocate($im, 127,127,127);
	$gray75 = imagecolorallocate($im, 191,191,191);
	$gray80 = imagecolorallocate($im, 204,204,204);
	$gray85 = imagecolorallocate($im, 217,217,217);
	$gray90 = imagecolorallocate($im, 230,230,230);
	$transp = imagecolorallocatealpha($im, 255,255,255,127);

for ($framenr=0; $framenr<$maxframe; $framenr++) {

	echo $framenr."\n";

	$gT = $framenr / $maxframe / 3;

	// load texture
	$texture = imagecreatefrompng(sprintf($argv[1], $framenr%60));
	if (!$texture)
	    die("failed to load wing texture\n");

	// background
//	imagefilledrectangle($im, 0, 0, $imw-1, $imh-1, rgb($gT*3 + 12/60));
	imagefilledrectangle($im, 0, 0, $imw-1, $imh-1, $gray80);

	// guideline
	$Ax = $initialPosx;
	$Bx = array();
	$Cx = array();
	calcControls($Ax,$Bx,$Cx);
	$Ay = $initialPosy;
	$By = array();
	$Cy = array();
	calcControls($Ay,$By,$Cy);
	$m = count($Ax);
if (0)
	for ($k=0; $k<$m; $k++) {
		for ($i = 1; $i < $maxslice; $i++) {
			$t = $i / $maxslice;
			$t1 = 1 - $t;

			$x = $Ax[$k]*$t1*$t1*$t1 + $Bx[$k]*$t*$t1*$t1*3 + $Cx[$k]*$t*$t*$t1*3 + $Ax[($k+1)%$m]*$t*$t*$t;
			$y = $Ay[$k]*$t1*$t1*$t1 + $By[$k]*$t*$t1*$t1*3 + $Cy[$k]*$t*$t*$t1*3 + $Ay[($k+1)%$m]*$t*$t*$t;
			imagesetpixel($im, $x, $y, $black);
		}
	}

	// determine sequence
	$t0 = $gT;
	$t1 = $gT + 1/3.0;
	$t2 = $gT + 2/3.0;
	$t1 = $t1 - floor($t1);
	$t2 = $t2 - floor($t2);
	$v0 = size_getv($t0);
	$v1 = size_getv($t1);
	$v2 = size_getv($t2);
	if ($v0 < $v1 && $v1 < $v2) {
		render(0, $t0);
		render(1, $t1);
		render(2, $t2);
	} else if ($v0 < $v1) {
		render(0, $t0);
		render(2, $t2);
		render(1, $t1);
	} else if ($v1 < $v2 && $v2 < $v0) {
		render(1, $t1);
		render(2, $t2);
		render(0, $t0);
	} else if ($v1 < $v2) {
		render(1, $t1);
		render(0, $t0);
		render(2, $t2);
	} else if ($v2 < $v0 && $v0 < $v1) {
		render(2, $t2);
		render(0, $t0);
		render(1, $t1);
	} else if ($v2 < $v0) {
		render(2, $t2);
		render(1, $t1);
		render(0, $t0);
	}

	imagepng($im, sprintf($argv[2], $framenr));
}
