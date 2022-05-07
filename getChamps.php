<?php
include 'api.php';

$lang = "en_US";
$champs_name_json = json_decode(
            file_get_contents(
                'http://ddragon.leagueoflegends.com/cdn/12.8.1/data/' . $lang . '/champion.json' .
                '?api_key=' .
                $api
            ),
            true
        );
        file_put_contents('json/' . $lang .'_champs.json', json_encode($champs_name_json, JSON_UNESCAPED_UNICODE));
         

        $champs_name_arr = [];
        // echo  count($champs_name_json['data']);
        // $all_champs = [];
        foreach ($champs_name_json['data'] as $key => $value){
            $champs_name_arr[$value['key']] =
            $value['name'];
            $all_champs[$value['key']] =  $value['name'];
            
        }
        
        file_put_contents('json/'. $lang . '_champs_name.json', json_encode($champs_name_arr, JSON_UNESCAPED_UNICODE));
         
        
?>

