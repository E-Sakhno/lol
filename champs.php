<?php
include 'api.php';

$lang = "zh_TW";
$champs_name_json = json_decode(
            file_get_contents(
                'http://ddragon.leagueoflegends.com/cdn/12.8.1/data/' . $lang . '/champion.json' .
                '?api_key=' .
                $api
            ),
            true
        );
        file_put_contents('json/' . $lang .'_champs.json', json_encode($champs_name_json, JSON_UNESCAPED_UNICODE));
         
?>