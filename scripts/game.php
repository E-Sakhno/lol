<?php

        $info_champ = json_decode(file_get_contents('http://ddragon.leagueoflegends.com/cdn/' . $version . '/data/' . $_COOKIE['lang'] . '/champion/' .  $champs_name_ava[$value['championId']] . '.json'), true);
        $tips = '';
        foreach ($info_champ['data'][$champs_name_ava[$value['championId']]][$vs[$value['teamId']]] as $ky => $vle){
            $tips .= '<p>' . $vle . '</p>';
            }

            if (!array_key_exists(mb_strtolower(str_replace(' ', '%20', $value['summonerName']), 'UTF-8'), $sum_ids)){
            $sum_ids[mb_strtolower(str_replace(' ', '%20', $value['summonerName']), 'UTF-8')] = $value['summonerId'];
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
            $champs_of_player = "<img src=\"http://ddragon.leagueoflegends.com/cdn/" . $version . "/img/champion/" . $ava[$info[$value['summonerId']][$k['max_key']]] . '">' . $champs_name_arr[$info[$value['summonerId']][$k['max_key']]] . ': ' . number_format($info[$value['summonerId']][$k['max_point']], 0, '', '&nbsp;');
            $total_masters = $info[$value['summonerId']][$k['total']];
            $champs_count = $info[$value['summonerId']][$k['7']] + $info[$value['summonerId']][$k['6']] + $info[$value['summonerId']][$k['5']]+$info[$value['summonerId']][$k['4']] + $info[$value['summonerId']][$k['3']] + $info[$value['summonerId']][$k['2']] + $info[$value['summonerId']][$k['1']]; 
            if ($info[$value['summonerId']][$k['7']] >0 or $info[$value['summonerId']][$k['6']]>0){
                $mast_echo = "<div style=\"margin-top: 0.5em; margin-bottom: 0.5em;\">" . $lang['Mastery'] . ":<br>";}
                else{
                    $mast_echo = '';
                }
                if ($info[$value['summonerId']][$k['7']]>0){
                    $mast_7 =  "<div>7 " . $lang['mastery_lvl']. ": " . $info[$value['summonerId']][$k['7']] . "</div>";
                }
                else{
                    $mast_7 = '';
                }

                if ($info[$value['summonerId']][$k['6']]>0){
                    $mast_6 =  "<div>6 " . $lang['mastery_lvl']. ": " . $info[$value['summonerId']][$k['6']] . "</div>";
                }
                else{
                    $mast_6 = '</div>';
                }

            
    
                echo '<tr><td>
                <div class="summoner" style="margin-top: 0.5em; margin-bottom: 1em;">
                <img src="http://ddragon.leagueoflegends.com/cdn/' . $version . '/img/profileicon/' . $value['profileIconId'] . '.png">' .
                '<a href="full_info.php?nick='. $value['summonerName'] . "&region="  . $_GET['region'] . '">' . 
                '<div class="nick">' . $value['summonerName'] . '</div></a></div>' .
            
            "<div class=\"cgs\"><div>" . $lang['Total_points'] . ": " . number_format($total_masters, 0, "", "&nbsp;") . 
            "</div><div>" . $lang['Played_on'] . " " . $champs_count . " / " . $champs_max .  
            "</div><div>" . $lang['Most_points'] . ": " . '<div class="topchamp">' . $champs_of_player . " (" . number_format($info[$value['summonerId']][$k['max_point']]/$total_masters*100, 2, ',', '') . "%)</div></div>" .
            "<div style=\"margin-top: 0.5em;\">" .
            $mast_echo . $mast_7 . $mast_6 .
            "</div></div></td>" . 
            
            '<td id="'. $value['championId'] . '"><div class="curchamps"><img id="' . $value['championId'] . '"src="http://ddragon.leagueoflegends.com/cdn/' . $version . "/img/champion/" . $ava[$value['championId']] . 
                    
             '"><br>' . $champs_name_arr[$value['championId']] . '</div></td>' . 
            '<td>' . $tips . '</td></tr>'
    ;
        
?>