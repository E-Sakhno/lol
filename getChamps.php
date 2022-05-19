<?php
include 'api.php';

$lang = "ru_RU";
$champs_name_json = json_decode(
            file_get_contents(
                'http://ddragon.leagueoflegends.com/cdn/' . $version . '/data/' . $lang . '/champion.json' .
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
            $value['id'];
            $all_champs[$value['key']] =  $value['id'];
            
        }
        
        file_put_contents('json/'. $lang . '_champs_id.json', json_encode($champs_name_arr, JSON_UNESCAPED_UNICODE));
         
        
?>

