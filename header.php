<link rel="stylesheet" href="style/total.css">
<script src="scripts/show_more.js"></script>
<script src="scripts/select_click.js"></script>




<?php
if ($_COOKIE['tz']){
    
    $tz = $_COOKIE['tz'];
    date_default_timezone_set($tz);
   }

$k = [
    'nick' => 0,
    'region' => 1,
    'icon' => 2,
    'lvl' => 3,
    'total' => 4,
    'min_key' => 5,
    'min_point' => 6,
    'max_key' => 7,
    'max_point' => 8,
    'early_key' => 9,
    'early_point' => 10,
    '7' => 11,
    '6' => 12,
    '5' => 13,
    '4' => 14,
    '3' => 15,
    '2' => 16,
    '1' => 17,
];

$l = [
    'nick' => 0,
    'region' => 1,
    'lp' => 2,
    'wins' => 3,
    'losses' => 4,
    'tier' => 5,
    'rank' => 6,
    'add' => 7
];

// $t = [
//     'nick' => 0,
//     'region' => 1,
//     'lp' => 2,
//     'wins' => 3,
//     'losses' => 4
// ];

$add = [
    'IRON' => '&zwnj;',
    'BRONZE' => '&zwnj;',
    'SILVER' => '&shy;&shy;',
    'GOLD' => '&shy;&shy;',
    'PLATINUM' => '&shy;',
    'DIAMOND' => '&shy;',
    'MASTER' => '',
    'GRANDMASTER' => '',
    'CHALLENGER' => '',
    '-' => '',
];
$version = '12.9.1';

$lang = json_decode(file_get_contents('lang/' . $_COOKIE['lang'] . '.json'), true);
    
?>

<div class="body">

