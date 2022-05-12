<?php

if ($_GET['region'] == 'all') {
    $ru = json_decode(file_get_contents('json/ru_summoners_arr.json'), true);
    $euw1 = json_decode(file_get_contents('json/euw1_summoners_arr.json'), true);
    $info = array_merge($ru, $euw1);
    
    
    $ru_rang = json_decode(file_get_contents('json/ru_summoners_rang_solo.json'), true);
    $euw1_rang = json_decode(file_get_contents('json/euw1_summoners_rang_solo.json'), true);
    $info_rang = array_merge($ru_rang, $euw1_rang);
} 

else {
    $info = json_decode(
        file_get_contents('json/'.$_GET['region'] . '_summoners_arr.json'),
        true
    );

    $info_rang = json_decode(
        file_get_contents('json/'.$_GET['region'] . '_summoners_rang_' . $_GET['qu'] .'.json'),
        true
    );
}

?>
