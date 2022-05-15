<?php
$masters = json_decode(
    file_get_contents(
        'https://' .
            $region_s .
            '.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/' .
            $summoner_id .
            '?api_key=' .
            $api
    ),
    true
);

$masters_arr = [];
for ($i = 0; $i < count($masters); $i++) {
    $masters_arr[$masters[$i]['championId']] =
        $masters[$i]['championPoints'];
}
$last_play = [];
foreach ($masters as $ky => $rw) {
// echo $masters[$key]['championId'].' ';
    $last_play[$masters[$ky]['championId']] = $rw['lastPlayTime'];
}
asort($last_play);
$total_masters = array_sum($masters_arr);


    /// норм, но много текста, далеко листать для отладки
    
    $champs_count = count($masters_arr);

    $info[$summoner_id] = [
        $summoner_info['name'],
        $_GET['region'],
        $summoner_info['profileIconId'],
        '?',
        $total_masters,
        array_key_last($masters_arr),
        $masters_arr[array_key_last($masters_arr)],
        array_key_first($masters_arr),
        $masters_arr[array_key_first($masters_arr)],
        array_key_first($last_play),
        $last_play[array_key_first($last_play)],
        array_count_values(array_column($masters, 'championLevel'))[7],
        array_count_values(array_column($masters, 'championLevel'))[6],
        array_count_values(array_column($masters, 'championLevel'))[5],
        array_count_values(array_column($masters, 'championLevel'))[4],
        array_count_values(array_column($masters, 'championLevel'))[3],
        array_count_values(array_column($masters, 'championLevel'))[2],
        array_count_values(array_column($masters, 'championLevel'))[1],
    ];

        
        file_put_contents(
            'json/' . $_GET['region_s'] . '_summoners_arr.json',
            json_encode($info, JSON_UNESCAPED_UNICODE)
        );
?>