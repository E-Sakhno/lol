<?php

        $info_champ = json_decode(file_get_contents('http://ddragon.leagueoflegends.com/cdn/' . $version . '/data/' . $_COOKIE['lang'] . '/champion/' .  $champs_name_ava[$value['championId']] . '.json'), true);
        $tips = '';
        foreach ($info_champ['data'][$champs_name_ava[$value['championId']]][$vs[$value['teamId']]] as $ky => $vle){
            $tips .= '<p>' . $vle . '</p>';
            }

            if (!array_key_exists($value['summonerId'], $info)){
           
            

            $masters = json_decode(
                file_get_contents(
                    'https://' .
                        $region .
                        '.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/' .
                        $value['summonerId'] .
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

                $info[$value['summonerId']] = [
                    $value['summonerName'],
                    $_GET['region'],
                    $value['profileIconId'],
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
            
            }
            $champs_of_player = "<img src=\"http://ddragon.leagueoflegends.com/cdn/" . $version . "/img/champion/" . $ava[$info[$value['summonerId']][$k['max_key']]] . '">' . $champs_name_arr[$info[$value['summonerId']][$k['max_key']]] . ': ' . number_format($info[$value['summonerId']][$k['max_point']], 0, '', ' ');
            $total_masters = $info[$value['summonerId']][$k['total']];
            $champs_count = $info[$value['summonerId']][$k['7']] + $info[$value['summonerId']][$k['6']] + $info[$value['summonerId']][$k['5']]+$info[$value['summonerId']][$k['4']] + $info[$value['summonerId']][$k['3']] + $info[$value['summonerId']][$k['2']] + $info[$value['summonerId']][$k['1']]; 
                
    
                echo '<tr><td>
                <div class="summoner">
                <img src="http://ddragon.leagueoflegends.com/cdn/' . $version . '/img/profileicon/' . $value['profileIconId'] . '.png">' .
                '<a href="full_info.php?nick='. $value['summonerName'] . "&region="  . $_GET['region'] . '">' . 
                '<div class="nick">' . $value['summonerName'] . '</div></div></td>' .
            
            '<td>'.  number_format($total_masters, 0, "", " ") . "</td>". 
            "<td>" . $champs_count . " / " . $champs_max . "</td>" . 
            "<td id=\"" . $champs_name_arr[$info[$value['summonerId']][$k['max_key']]] . '"><div class="curchamps">' . $champs_of_player . "</div></td>" . 
            
            '<td id="'. $value['championId'] . '"><div class="curchamps"><img src="http://ddragon.leagueoflegends.com/cdn/' . $version . "/img/champion/" . $ava[$value['championId']] . 
                    
             '">' . $champs_name_arr[$value['championId']] . '</div></td>' . 
            '<td>' . $tips . '</td></tr>'
    ;
        
?>