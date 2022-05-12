<?php

if ($_GET['region'] == 'all') {
    $ru = json_decode(file_get_contents('json/ru_summoners_arr.json'), true);
    $euw1 = json_decode(file_get_contents('json/euw1_summoners_arr.json'), true);
    $info = array_merge($ru, $euw1);
    
    
    $ru_rang = json_decode(file_get_contents('json/ru_summoners_rang.json'), true);
    $euw1_rang = json_decode(file_get_contents('json/euw1_summoners_rang.json'), true);
    $info_rang = array_merge($ru, $euw1);
} 

else {
    $info = json_decode(
        file_get_contents('json/'.$_GET['region'] . '_summoners_arr.json'),
        true
    );

    $info_rang = json_decode(
        file_get_contents('json/'.$_GET['region'] . '_summoners_rang.json'),
        true
    );
}

?>
