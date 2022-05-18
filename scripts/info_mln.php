<?php

if ($_GET['region'] == 'all') {
    $br1 = json_decode(file_get_contents('json/mln/br1_summoners_mln.json'), true);
    $eun1 = json_decode(file_get_contents('json/mln/eun1_summoners_mln.json'), true);
    $euw1 = json_decode(file_get_contents('json/mln/euw1_summoners_mln.json'), true);
    $jp = json_decode(file_get_contents('json/mln/jp1_summoners_mln.json'), true);
    $kr = json_decode(file_get_contents('json/mln/kr_summoners_mln.json'), true);
    $la1 = json_decode(file_get_contents('json/mln/la1_summoners_mln.json'), true);
    $la2 = json_decode(file_get_contents('json/mln/la2_summoners_mln.json'), true);
    $na = json_decode(file_get_contents('json/mln/na1_summoners_mln.json'), true);
    $oc = json_decode(file_get_contents('json/mln/oc1_summoners_mln.json'), true);
    $ru = json_decode(file_get_contents('json/mln/ru_summoners_mln.json'), true);
    $tr = json_decode(file_get_contents('json/mln/tr1_summoners_mln.json'), true);
    $mln = array_merge($br1, $eun1, $euw1, $jp, $kr, $la1, $la2, $na, $oc, $ru, $tr);
    
    }


else {
    $mln = json_decode(
        file_get_contents('json/mln/'.$_GET['region'] . '_summoners_mln.json'),
        true
    );


}

?>
