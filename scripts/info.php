<?php

if ($_GET['region'] == 'all') {
    $br1 = json_decode(file_get_contents('json/br1_summoners_arr.json'), true);
    $eun1 = json_decode(file_get_contents('json/eun1_summoners_arr.json'), true);
    $euw1 = json_decode(file_get_contents('json/euw1_summoners_arr.json'), true);
    $jp = json_decode(file_get_contents('json/jp1_summoners_arr.json'), true);
    $kr = json_decode(file_get_contents('json/kr_summoners_arr.json'), true);
    $la1 = json_decode(file_get_contents('json/la1_summoners_arr.json'), true);
    $la2 = json_decode(file_get_contents('json/la2_summoners_arr.json'), true);
    $na = json_decode(file_get_contents('json/na1_summoners_arr.json'), true);
    $oc = json_decode(file_get_contents('json/oc1_summoners_arr.json'), true);
    $ru = json_decode(file_get_contents('json/ru_summoners_arr.json'), true);
    $tr = json_decode(file_get_contents('json/tr1_summoners_arr.json'), true);
    $info = array_merge($br1, $eun1, $euw1, $jp, $kr, $la1, $la2, $na, $oc, $ru, $tr);
    
    if (isset($_GET['qu'])){
    $br1_rang = json_decode(file_get_contents('json/br1_summoners_rang_' . $_GET['qu'] . '.json'), true);
    $eun1_rang = json_decode(file_get_contents('json/eun1_summoners_rang_' . $_GET['qu'] . '.json'), true);
    $euw1_rang = json_decode(file_get_contents('json/euw1_summoners_rang_' . $_GET['qu'] . '.json'), true);
    $jp_rang = json_decode(file_get_contents('json/jp1_summoners_rang_' . $_GET['qu'] . '.json'), true);
    $kr_rang = json_decode(file_get_contents('json/kr_summoners_rang_' . $_GET['qu'] . '.json'), true);
    $la1_rang = json_decode(file_get_contents('json/la1_summoners_rang_' . $_GET['qu'] . '.json'), true);
    $la2_rang = json_decode(file_get_contents('json/la2_summoners_rang_' . $_GET['qu'] . '.json'), true);
    $na_rang = json_decode(file_get_contents('json/na1_summoners_rang_' . $_GET['qu'] . '.json'), true);
    $oc_rang = json_decode(file_get_contents('json/oc1_summoners_rang_' . $_GET['qu'] . '.json'), true);
    $ru_rang = json_decode(file_get_contents('json/ru_summoners_rang_' . $_GET['qu'] . '.json'), true);
    $tr_rang = json_decode(file_get_contents('json/tr1_summoners_rang_' . $_GET['qu'] . '.json'), true);
    $info_rang = array_merge($br1_rang, $eun1_rang, $euw1_rang, $jp_rang, $kr_rang, $la1_rang, $la2_rang, $na_rang, $oc_rang, $ru_rang, $tr_rang);

    // $ru_rang = json_decode(file_get_contents('json/ru_summoners_rang_' . $_GET['qu'] . '.json'), true);
    // $euw1_rang = json_decode(file_get_contents('json/euw1_summoners_rang_' . $_GET['qu'] . '.json'), true);
    // $info_rang = array_merge($ru_rang, $euw1_rang);
    }
} 

else {
    $info = json_decode(
        file_get_contents('json/'.$_GET['region'] . '_summoners_arr.json'),
        true
    );

    if (isset($_GET['qu'])){

    $info_rang = json_decode(
        file_get_contents('json/'.$_GET['region'] . '_summoners_rang_' . $_GET['qu'] .'.json'),
        true
    );
}
}

?>
