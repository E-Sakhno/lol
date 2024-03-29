<?php
include 'header.php';
echo '<h1>'.$lang['LiveGame'] . '</h1>';
?>
<title><?php echo $lang['LiveGame']; if(isset($_GET['nick'])){echo ' – ' . $_GET['nick'];} ?></title>

<div class="form">
<form action="current_game.php" method="get" name="form">
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


<!-- <script src="scripts/show_more.js"></script> -->

<?php

if (isset($_GET['nick'])) {
    // echo 'Имя призывателя: ' . $_GET['nick'] . '<br>';
    // echo 'Регион: ' . $_GET['region'] . '<br>';

    include 'api.php';
    include 'scripts/info.php';
    // print_r($info);

    $nick = $_GET['nick'];
    $nick_repl = str_replace(' ', '%20', $nick);
    $region = $_GET['region'];
    $sum_ids = json_decode(
        file_get_contents(
            'json/ids/' . $_GET['region'] . '_summoners_ids.json'
        ),
        true
    );
    // print_r ($sum_ids);
    if (array_key_exists(mb_strtolower($nick_repl, 'UTF-8'), $sum_ids)) {
        $summoner_info = [];

        $summoner_info['id'] = $sum_ids[mb_strtolower($nick_repl, 'UTF-8')];
        $summoner_info['name'] = mb_strtolower($nick, 'UTF-8');
        // print_r ($summoner_info);
    } else {
        // print_r($sum_ids);

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
    }

    // print_r ($summoner_info);

    if ($summoner_info == null) {
        echo $lang['404'];
    } else {

        // print_r ($summoner_info);
        $summoner_id = $summoner_info['id'];

        $url = 'https://' .
        $region .
        '.api.riotgames.com/lol/spectator/v4/active-games/by-summoner/' .
        $summoner_id .
        '?api_key=' .
        $api; 
        function get_http_response_code($url) {
            $headers = get_headers($url);
            return substr($headers[0], 9, 3);
        }
        if(get_http_response_code($url) != "200"){
            echo "<div class=\"center\">" . $lang['NotInGame'] . "</div>";
        }else
        {

        $game = json_decode(
            file_get_contents(
                'https://' .
                    $region .
                    '.api.riotgames.com/lol/spectator/v4/active-games/by-summoner/' .
                    $summoner_id .
                    '?api_key=' .
                    $api
            ),
            true
        );
        // $game = json_decode(file_get_contents('json/game.json'), true);

        $queue = json_decode(
            file_get_contents('lang/' . 
            $_COOKIE['lang'] . '_queues.json'
            ),
            true
        );
        // file_put_contents('json/game.json', json_encode($game, JSON_UNESCAPED_UNICODE));

        // print_r ($game);
        foreach ($game['participants'] as $key => $value) {
            if (
                mb_strtolower($value['summonerName'], 'UTF-8') ==
                $summoner_info['name']
            ) {
                if ($value['teamId'] == 100) {
                    $enemy = 200;
                } else {
                    $enemy = 100;
                }
                $vs = [$value['teamId'] => 'allytips', $enemy => 'enemytips'];
                $advice = [$value['teamId'] => $lang['with'], $enemy => $lang['vs']];
            }
        }

        $champs_name_json = json_decode(
            file_get_contents('json/' . $_COOKIE['lang'] . '_champs.json'),
            true
        );

        // print_r (($champs_name_json)['key']);
        $champs_name_arr = [];
        // echo  $champs_max;
        $all_champs = [];
        foreach ($champs_name_json['data'] as $ke => $valu) {
            $champs_name_arr[$valu['key']] = $valu['name'];
            $all_champs[$valu['key']] = $valu['name'];
        }

        echo '<div class="center">' . $queue[$game['gameQueueConfigId']][0] . " (" . $queue[$game['gameQueueConfigId']][1] . ")" . '</div>';
        ?>
<br>
<div class="center" style="color: red;"><?php echo $lang['RedTeam'];?></div>        

<div class="blok"> 
        <table id="sortable" border="1" >     
        
        <thead>
        <tr>
        <th  width="40%"> <?php echo $lang['InfoAbout'];?> </th>          
        <th width="10%"> <?php echo $lang['Playing'];?>  </th>
        <th  width="50%"> <?php echo $lang['Advice'];?> <?php echo $advice[200]; ?>  </th>
        </tr>
        </thead>
        <tbody>

    <?php
    $ava = json_decode(file_get_contents('json/ava_champs.json'), true);

    $champs_name_ava = json_decode(
        file_get_contents('json/en_US_champs_id.json'),
        true
    );
    // print_r($champs_name_ava);
    $champs_max = count($champs_name_json['data']);

    foreach ($game['participants'] as $key => $value) {
        if ($value['teamId'] == '200') {
            include 'scripts/game.php';
        }
    }
    ?>
</tbody>
</table>
</div>
<br>
<br>
<div class="center blue"><?php echo $lang['BlueTeam'];?></div>        

<div class="blok"> 
        <table id="srtble" border="1" >     
        
        <thead>
        <tr>
        <th  width="40%"> <?php echo $lang['InfoAbout'];?> </th>          
        <th width="10%"> <?php echo $lang['Playing'];?>  </th>
        <th  width="50%"> <?php echo $lang['Advice'];?> <?php echo $advice[100]; ?>  </th>
        </tr>
        </thead>
        <tbody>


    <?php
    foreach ($game['participants'] as $key => $value) {
        if ($value['teamId'] == '100') {
            include 'scripts/game.php';
        }
    }

    echo '</tbody>
    </table>
    </div>';

    // echo $summoner_id;
    // print_r($game);
    echo '<BR>';
    // $masters = json_decode(
    //     file_get_contents(
    //         'https://' .
    //             $region .
    //             '.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/' .
    //             $summoner_id .
    //             '?api_key=' .
    //             $api
    //     ),
    //     true
    // );

    // // print_r($masters);
    // // echo (array_count_values(array_column($masters, 'championLevel'))[7]);
    // $masters_arr = [];
    // for ($i = 0; $i < count($masters); $i++) {
    //     $masters_arr[$masters[$i]['championId']] =
    //         $masters[$i]['championPoints'];
    // }
    // $total_masters = array_sum($masters_arr);

    // echo "Всего очков на чемпионах: ". number_format($total_masters, 0, "", " ");

    // // file_put_contents('json/champs_name.json', json_encode($champs_name_arr, JSON_UNESCAPED_UNICODE));

    // echo "<br>";
    // echo "Сыграно на ". count($masters_arr) . " из " . $champs_max;
    // echo "<br><br>";

    // $dif_champ = array_diff_key($all_champs, $masters_arr);
    // if (count($masters_arr) != $champs_max){
    //     echo "<br>Не сыграно на: <br>";

    // }
    // foreach ($dif_champ as $key => $value){
    //    echo $value." ";

    // }

    // echo "<br><br>";
    //     echo '<table border="1" >     <tr>
    // <td> № </td>
    // <td> Герой </td>
    // <td> Очки  </td></tr>';

    //     $champs_of_player = [];
    //     /// норм, но много текста, далеко листать для отладки
    //     for ($n = 0; $n < count($masters); $n++) {
    //     echo $n + 1 . '. ' .$champs_name_arr[$masters[$n]['championId']]. " " . $masters[$n]['championPoints'] . "<br>\r\n";
    //     // echo "<tr><td>". $n + 1 . '</td><td> ' .$champs_name_arr[$masters[$n]['championId']]. "</td><td>" . $masters[$n]['championPoints'] . "</td><tr>";

    //     if ($n == 4){
    //         echo '  <div id="more" style="display: none;"> ';
    //     }
    // }
    // echo '</div><br><a href="javascript:void(0)" onclick="show(\'more\')">Все герои</a>';

    }
    foreach ($game['participants'] as $key => $value) {
        if ($info[$value['summonerId']][$k['lvl']] == '0'){
            $nick_repl_cur = str_replace(' ', '%20', $value['summonerName']);

            $summoner_info = json_decode(
                file_get_contents(
                    'https://' .
                        $region .
                        '.api.riotgames.com/lol/summoner/v4/summoners/by-name/' .
                        $nick_repl_cur .
                        '?api_key=' .
                        $api
                ),
                true
            );

            $info[$value['summonerId']][$k['lvl']] = $summoner_info['summonerLevel'];
        }

    }

    file_put_contents(
        'json/' . $_GET['region'] . '_summoners_arr.json',
        json_encode($info, JSON_UNESCAPED_UNICODE)
    );
    file_put_contents(
        'json/ids/' . $_GET['region'] . '_summoners_ids.json',
        json_encode($sum_ids, JSON_UNESCAPED_UNICODE)
    );
}
}

include 'footer.php';

?>
