<?php 
function numberFormat($digit, $width) {
    while(strlen($digit) < $width)
      $digit = '0' . $digit;
      return $digit;
}

for ($spc=960000;$spc<999999;$spc++) echo 'SPC('.numberFormat($spc, 6).')<br>Sleep(11000)<br>';


/*
function randomGen($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

print_r(randomGen(0,32768,32768)); //generates 20 unique random numbers
*/
?>
