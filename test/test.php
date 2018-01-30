<?php
//echo 'test';
$pn='101660-101';
for ($pn='101660-101';$pn<='101660-107';$pn++) {
    $pn_arr[]=$pn;
}
    for ($sn='PAB001';$sn<='PAB649';$sn++) {
    //	echo 'PN: '.$pn++.' SN: '.$sn.'<br>';
    	$sn_arr[]=$sn;
    }

foreach ($pn_arr as $pn) {
    foreach ($sn_arr as $sn) {
	 echo 'PN: '.$pn.' SN: '.$sn.'<br>';
	    }
}
//print_r($sn_arr);
?>