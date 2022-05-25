<?php
include 'header.php';
echo '<h1>'.$lang['Total-h'] . '</h1>';
?>
<div class="form">
<form action="full_info.php" method="get" name="form">
    <?php
    echo $lang['Nick'];
    ?>: 
    <input name="nick" id="nick" type="text" class="inp" value="<?php if (isset($_GET['nick'])) {echo $_GET['nick'];} ?>" placeholder="<?php echo $lang['Nick_ph'];?>">
     
<?php 

include 'scripts/region_sum.php'; ?>  
    <button class="btn btn-success btn">&#128269;</button>
</form>
</div>
<script src="scripts/block.js"></script>


<?php if (isset($_GET['nick'])) {
    include 'api.php';
    $nick = $_GET['nick'];
    $nick_repl = str_replace(' ', '%20', $nick);
    // echo $nick_repl;
    $region = $_GET['region'];
    $summoner_info = json_decode(
        file_get_contents(
            'https://' .
                $region .
                '.api.riotgames.com/lol/summoner/v4/summoners/by-name/' .
                $nick_repl .
                '?api_key=' .
                $api
        ),
        true
    );

    if ($summoner_info == null) {
        echo '<div class="center">' . $lang['404'] . '</div>';
    } else {
        $summoner_id = $summoner_info['id'];

        

        // echo '<BR>';
        // echo 'Имя призывателя: ' . $summoner_info['name'] . '<br>';
        // echo 'Регион: ' . $_GET['region'] . '<br>';

        $rang = json_decode(
            file_get_contents(
                'https://' .
                    $region .
                    '.api.riotgames.com/lol/league/v4/entries/by-summoner/' .
                    $summoner_id .
                    '?api_key=' .
                    $api
            ),
            true
        );
        // print_r($rang);
        // $add = [
        //     'IRON' => '&zwnj;',
        //     'BRONZE' => '&zwnj;',
        //     'SILVER' => '&shy;&shy;',
        //     'GOLD' => '&shy;&shy;',
        //     'PLATINUM' => '&shy;',
        //     'DIAMOND' => '&shy;',
        //     'MASTER' => '',
        //     'GRANDMASTER' => '',
        //     'CHALLENGER' => '',
        //     '-' => '',
        // ];
        // [queueType] => RANKED_FLEX_SR
        $num_rank = 0;
        $num_rank_flex = 0;
        $num_rank_tft = 0;
        foreach ($rang as $key => $value) {
            if ($value['queueType'] == 'RANKED_SOLO_5x5') {
                break;
            }
            $num_rank++;
        }
        // echo '<BR>';
        if (
            !empty($rang) and
            ($rang[$num_rank]['queueType'] == 'RANKED_SOLO_5x5')
        ) {
            $tier = $rang[$num_rank]['tier'];
            $rank = $rang[$num_rank]['rank'];
            // $add_r = $add[$tier];
            $lp = $rang[$num_rank]['leaguePoints'];
            $wins = $rang[$num_rank]['wins'];
            $losses = $rang[$num_rank]['losses'];

            $summoners_rang = json_decode(
                file_get_contents(
                    'json/' . $_GET['region'] . '_summoners_rang_solo.json'
                ),
                true
            );

            $summoners_rang[$summoner_id] = [
                $summoner_info['name'],
                $_GET['region'],
                $lp,
                $wins,
                $losses,
                $tier,
                $rank,
                // $add_r,
            ];

            file_put_contents(
                'json/' . $_GET['region'] . '_summoners_rang_solo.json',
                json_encode($summoners_rang, JSON_UNESCAPED_UNICODE)
            );
        }


        // print_r($rang);

        foreach ($rang as $key => $value) {
            if ($value['queueType'] == 'RANKED_FLEX_SR') {
                break;
            }
            $num_rank_flex++;
        }
        // echo '<BR>';
        if (
            !empty($rang) and
            $rang[$num_rank_flex]['queueType'] == 'RANKED_FLEX_SR'
        ) {
            $tier = $rang[$num_rank_flex]['tier'];
            $rank = $rang[$num_rank_flex]['rank'];
            // $add_r = $add[$tier];
            $lp = $rang[$num_rank_flex]['leaguePoints'];
            $wins = $rang[$num_rank_flex]['wins'];
            $losses = $rang[$num_rank_flex]['losses'];

            $summoners_rang = json_decode(
                file_get_contents(
                    'json/' . $_GET['region'] . '_summoners_rang_flex.json'
                ),
                true
            );

            $summoners_rang[$summoner_id] = [
                $summoner_info['name'],
                $_GET['region'],
                $lp,
                $wins,
                $losses,
                $tier,
                $rank,
                // $add_r,
            ];

            file_put_contents(
                'json/' . $_GET['region'] . '_summoners_rang_flex.json',
                json_encode($summoners_rang, JSON_UNESCAPED_UNICODE)
            );
        }


        foreach ($rang as $key => $value) {
            if ($value['queueType'] == 'RANKED_TFT_PAIRS') {
                break;
            }
            $num_rank_tft++;
        }
        // echo '<BR>';
        if (
            !empty($rang) and
            $rang[$num_rank_tft]['queueType'] == 'RANKED_TFT_PAIRS'
        ) {
            // $tier = $rang[$num_rank_tft]['tier'];
            // $rank = $rang[$num_rank_tft]['rank'];
            // $add_r = $add[$tier];
            $lp = $rang[$num_rank_tft]['leaguePoints'];
            $wins = $rang[$num_rank_tft]['wins'];
            $losses = $rang[$num_rank_tft]['losses'];

            $summoners_rang = json_decode(
                file_get_contents(
                    'json/' . $_GET['region'] . '_summoners_rang_tft.json'
                ),
                true
            );

            $summoners_rang[$summoner_id] = [
                $summoner_info['name'],
                $_GET['region'],
                // $tier,
                // $rank,
                // $add_r,
                $lp,
                $wins,
                $losses,
            ];

            file_put_contents(
                'json/' . $_GET['region'] . '_summoners_rang_tft.json',
                json_encode($summoners_rang, JSON_UNESCAPED_UNICODE)
            );
        }



        









        //   echo empty($rank);
        // echo '<img src="http://ddragon.leagueoflegends.com/cdn/' .
        //     $version .
        //     '/img/profileicon/' .
        //     $summoner_info['profileIconId'] .
        //     '.png">';

        // echo '<BR>';
        
        // echo '<BR>';
        // echo 'Уровень: ' . $summoner_info['summonerLevel'];
        // echo '<BR>';
        if ($rang[$num_rank]['tier'] == "CHALLENGER" and $rang[$num_rank]['rank'] == 'I'){
            $elo_solo = $lang[$rang[$num_rank]['tier']] . ' ' . $rang[$num_rank]['leaguePoints'];
        }
        else{
            
            $elo_solo = $lang[$rang[$num_rank]['tier']] . ' ' . $rang[$num_rank]['rank'];
        }

        if ($rang[$num_rank_flex]['tier'] == "CHALLENGER" and $rang[$num_rank_flex]['rank'] == 'I'){
            $elo_flex = $lang[$rang[$num_rank_flex]['tier']] . ' ' . $rang[$num_rank_flex]['leaguePoints'];
        }
        else{
            
            $elo_flex = $lang[$rang[$num_rank_flex]['tier']] . ' ' . $rang[$num_rank_flex]['rank'];
        }


        echo '<table><tr><td>' .       
        '<div class="summoner"><img src="http://ddragon.leagueoflegends.com/cdn/' .
            $version .
            '/img/profileicon/' .
            $summoner_info['profileIconId'] .
            '.png">' . 
            '<div class="nick">' . 
            $summoner_info['name'] . 
            '<div class="region">' . 
            $_GET['region'] . 
            '</div></div></div></td><td>' . 
            $summoner_info['summonerLevel'] . ' ' . $lang['lvl'] . ' <a href="record_lvl.php?region=all&qu=solo&amount=10&nick=' . $nick_repl . '&region_s=' . $region . '">&#8658;</a>' . "</td></tr><div class=\"rang\">";
            if (empty($rang)) {
                echo '<tr><td>'. $lang['Elo'] .':</td><td> - </td></tr>';
            } else {
                if ($rang[$num_rank]){
    
                    echo '<tr><td>'. $lang['Elo'] . ' (' . $lang['solo'] . ')' .': </td><td>' . '<div class="rank_full"><img src="img/Emblem_' . $rang[$num_rank]['tier'] . ".png\"><div class=\"elo_full\">" . $elo_solo . ' <br>(' . $lang['w'] . ': ' . number_format($rang[$num_rank]['wins'], 0, '', ' ') . ', ' . $lang['l'] . ': ' . number_format($rang[$num_rank]['losses'], 0, '', ' ') . ' – ' . number_format( $rang[$num_rank]['wins'] / ($rang[$num_rank]['wins'] + $rang[$num_rank]['losses'])*100, 2, ',', ' ') . '%' . ' <a href="record_rank_winrate.php?qu=solo&region=all&amount=10&nick=' . $nick_repl . '&region_s=' . $region . '">&#8658;</a>' . ')</div></div></td></tr>';
                }
                if ($rang[$num_rank_flex]){
    
                echo '<tr><td>'. $lang['Elo'] . ' (' . $lang['flex'] . ')' .': </td><td>' . '<div class="rank_full"><img src="img/Emblem_' . $rang[$num_rank_flex]['tier'] . ".png\"><div class=\"elo_full\">" . $elo_flex . ' <br>(' . $lang['w'] . ': ' . number_format($rang[$num_rank_flex]['wins'], 0, '', ' ') . ', ' . $lang['l'] . ': ' . number_format($rang[$num_rank_flex]['losses'], 0, '', ' ') . ' – ' . number_format( $rang[$num_rank_flex]['wins'] / ($rang[$num_rank_flex]['wins'] + $rang[$num_rank_flex]['losses'])*100, 2, ',', ' ') . '%' . ' <a href="record_rank_winrate.php?qu=flex&region=all&amount=10&nick=' . $nick_repl . '&region_s=' . $region . '">&#8658;</a>' . ')</div></div></td></tr>';
            }
            else{
                echo '<tr><td>'. $lang['Elo'] . ' (' . $lang['flex'] . ')' .':</td><td> - </td></tr>';
    
            }
            }
            echo "</table>"; 
            
            
        
        // print_r ($summoner_info);
        $masters = json_decode(
            file_get_contents(
                'https://' .
                    $region .
                    '.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/' .
                    $summoner_id .
                    '?api_key=' .
                    $api
            ),
            true
        );

        $seven = array_count_values(array_column($masters, 'championLevel'))[7];
        $six = array_count_values(array_column($masters, 'championLevel'))[6];
        $five = array_count_values(array_column($masters, 'championLevel'))[5];
        $four = array_count_values(array_column($masters, 'championLevel'))[4];
        $three = array_count_values(array_column($masters, 'championLevel'))[3];
        $two = array_count_values(array_column($masters, 'championLevel'))[2];
        $one = array_count_values(array_column($masters, 'championLevel'))[1];


        echo '
        <table border="1" style="border-collapse: collapse;">
        <tr>
        <td>' . $lang['Rang'] . '</td>
        <td>7</td>
        <td>6</td>
        <td>5</td>
        <td>4</td>
        <td>3</td>
        <td>2</td>
        <td>1</td>
        </tr>
        <tr>
        <td>' . $lang['Amount'] . '</td>' .
        '<td>' . $seven . ' <a href="record_rang.php?rang=7&region=all&qu=solo&amount=10&nick=' . $nick_repl . '&region_s=' . $region . '">&#8658;</a>' .  "</td>" .   
        '<td>' . $six . ' <a href="record_rang.php?rang=6&region=all&qu=solo&amount=10&nick=' . $nick_repl . '&region_s=' . $region . '">&#8658;</a>' . "</td>" .   
        '<td>' . $five . ' <a href="record_rang.php?rang=5&region=all&qu=solo&amount=10&nick=' . $nick_repl . '&region_s=' . $region . '">&#8658;</a>' . "</td>" .   
        '<td>' . $four . ' <a href="record_rang.php?rang=4&region=all&qu=solo&amount=10&nick=' . $nick_repl . '&region_s=' . $region . '">&#8658;</a>' . "</td>" .   
        '<td>' . $three . ' <a href="record_rang.php?rang=3&region=all&qu=solo&amount=10&nick=' . $nick_repl . '&region_s=' . $region . '">&#8658;</a>' . "</td>" .   
        '<td>' . $two . ' <a href="record_rang.php?rang=2&region=all&qu=solo&amount=10&nick=' . $nick_repl . '&region_s=' . $region . '">&#8658;</a>' . "</td>" .   
        '<td>' . $one . ' <a href="record_rang.php?rang=1&region=all&qu=solo&amount=10&nick=' . $nick_repl . '&region_s=' . $region . '">&#8658;</a>' . "</td></tr>" .
        "</table>";
        $tmp = $seven * 7 + $six * 6 + $five*5 + $four*4 + $three*3 + $two * 2 + $one;
        echo "<div class=\"info_sum\"><div>". $lang["Sum_mastery"] . ": " . 
        $tmp  . 
        ' <a href="record_total_mastery.php?region=all&qu=solo&amount=10&nick=' . $nick_repl . '&region_s=' . $region . '">&#8658;</a></div>';

        
        // print_r($masters);
        // echo (array_count_values(array_column($masters, 'championLevel'))[7]);
        $masters_arr = [];
        for ($i = 0; $i < count($masters); $i++) {
            $masters_arr[$masters[$i]['championId']] =
                $masters[$i]['championPoints'];
        }
        $total_masters = array_sum($masters_arr);

        echo '<div>' . $lang['Sum_points'] . ': ' .
            number_format($total_masters, 0, '', '&nbsp;') . 
            ' <a href="record_total.php?region=all&qu=solo&amount=10&nick=' . $nick_repl . '&region_s=' . $region . '">&#8658;</a></div>';

        $champs_name_json = json_decode(
            file_get_contents('json/' . $_COOKIE['lang'] . '_champs.json'),
            true
        );

        $ava = json_decode(file_get_contents('json/ava_champs.json'), true);

        // print_r (($champs_name_json)['key']);
        $champs_name_arr = json_decode(
            file_get_contents('json/' . $_COOKIE['lang'] . '_champs_name.json'),
            true
        );
        // echo  count($champs_name_json['data']);
        foreach ($champs_name_json['data'] as $key => $value) {
            $champs_name_arr[$value['key']] = $value['name'];
        }

        echo '<div>' . $lang['Played_on'] . ' ' .
            count($masters_arr) .
            ' ' . $lang['of'] . ' ' .
            count($champs_name_json['data']) . 
            ' <a href="record_true_mainers.php?region=all&qu=solo&amount=10&nick=' . $nick_repl . '&region_s=' . $region . '">&#8658;</a>' .
            "</div>";
        // echo '<br><br>';
         

        $dif_champ = array_diff_key($champs_name_arr, $masters_arr);
        if (count($masters_arr) != count($champs_name_json['data'])) {
        echo $lang['DidntPlayed_on'] . ':<br>';
            
        }

        if (array_key_exists(777, $dif_champ)) {
            if ($dif_champ[777] == 'Ёнэ') {
                $dif_champ[777] = 'Енэ';
            }
        }
        asort($dif_champ);
        if (array_key_exists(777, $dif_champ)) {
            if ($dif_champ[777] == 'Енэ') {
                $dif_champ[777] = 'Ёнэ';
            }
        }
        // print_r($dif_champ);
        $ctr = 1;
        foreach ($dif_champ as $key => $value) {
            echo '<span class="champDP">' . $value . '</span>';
            if ($ctr == 5){
                echo '<div class="champDP_cont" id="more" style="display: none;">';
            }
            $ctr++;
        }
        echo '</div>';
        if ($ctr > 6){
        //    echo $ctr;
            echo '<a href="javascript:void(0)" id="show_link" onclick="show(\'more\')">' . $lang['AllChamps'] . '</a></div>';
        }
        // echo '<br><br>';
        $last_play = [];
        foreach ($masters as $key => $row) {
            // echo $masters[$key]['championId'].' ';
            $last_play[$masters[$key]['championId']] = $row['lastPlayTime'];
        }
        asort($last_play);
        // echo $last_play[array_key_first($last_play)];
        // array_multisort($last_play, SORT_ASC, $masters);

        // echo '<br><br>';
        // print_r ($masters);
        // print_r ($last_play);
        echo '<div class="blok"> 
        <table id="sortable" border="1" style="width: 100%; margin-top: 2em;" class="center">     
        
        <thead>
        <tr>
        <th data-type="number">№</th>         
             
    <th>' . $lang['Hero'] . '</th>          
    <th data-type="number">' . $lang['Point'] . '</th>
    <th data-type="number"> ' . $lang['Elo'] . '</th>
    <th>' . $lang['LastGame'] . '</th>
    <th>' . $lang['Chest'] . '</th>
    <th>' . $lang['tokensEarned'] . '</th>
    </tr>
    </thead>
    <tbody>
    
    
    ';
    $millons = [];

        // print_r ($masters);
        $champs_of_player = [];
        /// норм, но много текста, далеко листать для отладки
        for ($n = 0; $n < count($masters); $n++) {
            if ($masters[$n]['championPoints'] >= 1000000){
                $millons[$masters[$n]['championId']] = $masters[$n]['championPoints'];   

            }
            $n_1 = $n + 1;
            echo '<tr><td>' .
                $n_1 .
                '</td><td id="' .$masters[$n]['championId'] . '">' .
                '<div class="fullchamp">' . 
                "<img id=\"" . $champs_name_arr[$masters[$n]['championId']] ."\"" . "src=\"http://ddragon.leagueoflegends.com/cdn/" .
                $version .
                '/img/champion/' .
                $ava[$masters[$n]['championId']] .
                '"><div class="fullchampname">' .
                
                $champs_name_arr[$masters[$n]['championId']] .
                '</div></div></td><td>' .
                number_format($masters[$n]['championPoints'], 0, '', '&nbsp;') .
                '</td><td>' .
                $masters[$n]['championLevel'] .
                '</td><td>' .
                date('Y.m.d H:i', $masters[$n]['lastPlayTime'] / 1000) .
                '</td><td>' .
                str_replace(1, '+', $masters[$n]['chestGranted']) .
                '</td><td>' .
                str_replace(0, '', $masters[$n]['tokensEarned']) .
                '</td></tr>';
        }

        echo '</tbody></table></div>';
        $summoners_top = json_decode(
            file_get_contents(
                'json/' . $_GET['region'] . '_summoners_arr.json'
            ),
            true
        );
        // echo "Начальный массив <br>";

        //    echo is_array($summoners_top);

        $summoners_top[$summoner_id] = [
            $summoner_info['name'],
            $_GET['region'],
            $summoner_info['profileIconId'],
            $summoner_info['summonerLevel'],
            $total_masters,
            array_key_last($masters_arr),
            $masters_arr[array_key_last($masters_arr)],
            array_key_first($masters_arr),
            $masters_arr[array_key_first($masters_arr)],
            array_key_first($last_play),
            $last_play[array_key_first($last_play)],
            $seven,
            $six,
            $five,
            $four,
            $three,
            $two,
            $one
        ];

        file_put_contents(
            'json/' . $_GET['region'] . '_summoners_arr.json',
            json_encode($summoners_top, JSON_UNESCAPED_UNICODE)
        );

        $sum_ids = json_decode(
            file_get_contents(
                'json/ids/' . $_GET['region'] . '_summoners_ids.json'
            ),
            true
        );

        if (!array_key_exists(mb_strtolower($nick_repl, 'UTF-8'), $sum_ids)){

            
            
            $sum_ids[mb_strtolower($nick_repl, 'UTF-8')] = $summoner_id;
            
            file_put_contents(
                'json/ids/' . $_GET['region'] . '_summoners_ids.json',
                json_encode($sum_ids, JSON_UNESCAPED_UNICODE)
            );
        }
            
        if ($millons != NULL){
// echo 'MIL';
            $sum_mln = json_decode(
                file_get_contents(
                    'json/mln/' . $_GET['region'] . '_summoners_mln.json'
                ),
                true
            );
            
            $sum_mln[$summoner_id] = $millons;
            
            // print_r($sum_ids);
            file_put_contents(
                'json/mln/' . $_GET['region'] . '_summoners_mln.json',
                json_encode($sum_mln, JSON_UNESCAPED_UNICODE)
            );
        }
            
            
    }
} 
include "footer.php";
?>
