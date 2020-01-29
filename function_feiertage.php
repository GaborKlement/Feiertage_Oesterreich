<?php

/*

https://github.com/GaborKlement/Feiertage_Oesterreich

MIT License

Copyright (c) 2020 Gabor Klement

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

*/

$y = date("Y", time());

function ostern() {
    
    global $y;
    
    if ($y >= 1900 && $y <= 2099) { $m = 24; $n = 5; } 
    if ($y >= 2100 && $y <= 2199) { $m = 24; $n = 6; }
    if ($y >= 2200 && $y <= 2299) { $m = 25; $n = 0; }
    
    $a = fmod($y,19);
    $b = fmod($y,4);
    $c = fmod($y,7);
    
    $r1 = (19 * $a) +  $m;
    $d = fmod($r1, 30);
    
    $r2 = (2 * $b) + (4 * $c) + (6 * $d) + $n;
    $e = fmod($r2,7);
    
    if (($d + $e) < 10) { $om = 3; $ot = $d + $e + 22; }
    else { $om = 4; $ot = $d + $e - 9; }
    
    if ($om == 4 && $ot == 26 ) { $om = 4; $ot = 19; }
    if ($om == 4 && $ot == 25 && $d == 28 && $e == 6 && $a > 10) { $om = 4; $ot = 18; }
    
    $o = mktime(3,0,0,$om,$ot,$y,-1) + 86400;
    
    return $o;
    
}

function feiertage() {
    
    global $y;
    
    $christi_himmelfahrt = strtotime("+38 days", ostern());
    $pfingstmontag       = strtotime("+11 days", $christi_himmelfahrt);
    $fronleichnam        = strtotime("+10 days", $pfingstmontag);

    $feiertagArray = array(mktime(3,0,0,1,1,$y,-1), mktime(3,0,0,1,6,$y,-1), mktime(3,0,0,5,1,$y,-1), mktime(3,0,0,8,15,$y,-1), mktime(3,0,0,10,26,$y,-1), mktime(3,0,0,11,1,$y,-1), mktime(3,0,0,12,8,$y,-1), mktime(3,0,0,12,25,$y,-1), mktime(3,0,0,12,26,$y,-1), ostern(), $christi_himmelfahrt, $pfingstmontag, $fronleichnam);
    
    return $feiertagArray;
    
}

?>
