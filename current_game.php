<form action="current_game.php" method="get" name="form">
    Nick: <input name="nick" type="text" class="form-control inp" value="
    <?php if (isset($_GET['nick'])) {
        echo $_GET['nick'];
    } ?>
    "><br>
    Region: <select name="region"">
<option value="ru" 
    <?php if (isset($_GET['region'])){if ($_GET['region'] == "ru"){echo 'selected';}} ?> 
> Ru
    <option value="euw1" 
    <?php if (isset($_GET['region'])){if ($_GET['region'] == "euw1"){echo 'selected';}} ?> 
> EuW

</select>
    
    <br><br>    
    <!-- <input type="submit"> -->
    <button class="btn btn-success btn">Кнопка</button>
</form>

<script>

let inp = document.querySelector('input.inp');
let btn = document.querySelector('.btn');
btn.setAttribute('disabled', true);
 
inp.oninput = function(){
let val = inp.value;
  if (val.length < 1){
    btn.setAttribute('disabled', true);
  }else{
    btn.removeAttribute('disabled');
  }
}
</script>


<!-- <script src="scripts/show_more.js"></script> -->

<?php 
include 'header.php';

    if (isset($_GET['nick'])) {
        echo 'Имя призывателя: ' . $_GET['nick'] . '<br>';
        echo 'Регион: ' . $_GET['region'] . '<br>';

        include 'api.php';
        $nick = $_GET['nick'];
        $nick_repl = str_replace(' ', '%20', $nick);
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
        // print_r ($summoner_info);
        
        if ($summoner_info == NULL){
            echo "Такого пользователя не найдено!";
        }
        else{
        $summoner_id = $summoner_info['id'];

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

        // print_r ($game);
        foreach ($game['participants'] as $key => $value){
            if ($value['summonerName'] == $summoner_info['name']){
                if ($value['teamId'] == 100){
                    $enemy = 200;
                }
                else{
                    $enemy = 100;
                }
            $vs = [$value['teamId'] => 'allytips', $enemy => 'enemytips'];
            $advice = [$value['teamId'] => 'за', $enemy => 'против'];
            }
        }
                
        $champs_name_json = json_decode(
            file_get_contents(
                'json/' . $_COOKIE['lang'] . '_champs.json'
            ),
            true
        );
        
        // print_r (($champs_name_json)['key']);
        $champs_name_arr = [];
        // echo  count($champs_name_json['data']);
        $all_champs = [];
        foreach ($champs_name_json['data'] as $key => $value){
            $champs_name_arr[$value['key']] =
            $value['name'];
            $all_champs[$value['key']] =  $value['name'];
            
        }
        


        echo $game['mapId'] . ' ' . $game['gameMode'];
?>
<div class="blok"> 
        <table id="sortable" border="1" >     
        
        <thead>
        <tr>
        <th> Ava </th>         
        <th> Nick </th>          
        <th data-type="number"> Total </th>          
        <th data-type="number"> Сыграно на </th>          
        <th> Чемпионы с наибольшим количеством очков </th>          
        <th> Icon </th>          
    <th > Champ  </th>
    <th > Советы по игре <?php echo $advice[100]; ?>  </th>
    <!-- <th data-type="number"> Ранг  </th>
    <th> Последний раз сыграно  </th>
    <th> Сундук  </th>
    <th > Жетонов в инвентаре </th> -->
    </tr>
    </thead>
    <tbody>

    <?php

$ava = json_decode(
    file_get_contents(
        'json/ava_champs.json'),
    true
);

$champs_name_ava = json_decode(file_get_contents('json/en_US_champs_id.json'), true);
    // print_r($champs_name_ava);
    foreach ($game['participants'] as $key => $value){
        if ($value['teamId'] == '100'){
            //сделать нормальный массив для имен json'ов для получения советов
            $info = json_decode(file_get_contents('http://ddragon.leagueoflegends.com/cdn/' . $version . '/data/' . $_COOKIE['lang'] . '/champion/' .  $champs_name_ava[$value['championId']] . '.json'), true);
            $tips = '';
            foreach ($info['data'][$champs_name_ava[$value['championId']]][$vs[$value['teamId']]] as $ky => $vle){
                $tips .= '<p>' . $vle . '</p>';
                }
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
                $total_masters = array_sum($masters_arr);
        
                $champs_of_player = ' ';
                    /// норм, но много текста, далеко листать для отладки
                    for ($n = 0; $n < 3; $n++) {
                    $champs_of_player .= '<p>' . $n+1 . ". " . $champs_name_arr[$masters[$n]['championId']] . ": " .  number_format($masters[$n]['championPoints'], 0, '', ' ') . "</p>";
                    }
        
                    echo '<tr><td><img src="http://ddragon.leagueoflegends.com/cdn/12.9.1/img/profileicon/' . $value['profileIconId'] . '.png"></td>' .
                    '<td><a href="full_info.php?nick='. $value['summonerName'] . "&region="  . $_GET['region'] . '">' . $value['summonerName'] . '</td>' .
                
                "<td>" . number_format($total_masters, 0, "", " ") . "</td>". 
                "<td>" . count($masters_arr) . " / " . count($champs_name_json['data']) . "</td>" . 
                "<td>" . $champs_of_player . "</td>" . 
                
                "<td><img src=\"http://ddragon.leagueoflegends.com/cdn/12.9.1/img/champion/" . $ava[$value['championId']] . '">' . "</td>" . 
                
                '<td id="'. $value['championId'] . '">' . $champs_name_arr[$value['championId']] . '</td>' . 
                '<td>' . $tips . '</td></tr>'
        ;
        }
    }
    ?>
</tbody>
</table>
</div>
<br>
<br>
<br>
<div class="blok"> 
        <table id="srtble" border="1" >     
        
        <thead>
        <tr>
        <th> Ava </th>         
        <th> Nick </th>          
        <th data-type="number"> Total </th>          
        <th data-type="number"> Сыграно на </th>          
        <th> Чемпионы с наибольшим количеством очков </th>          
        <th> Icon </th>          
    <th > Champ  </th>
    <th > Советы по игре <?php echo $advice[200]; ?>  </th>
    <!-- <th data-type="number"> Ранг  </th>
    <th> Последний раз сыграно  </th>
    <th> Сундук  </th>
    <th > Жетонов в инвентаре </th> -->
    </tr>
    </thead>
    <tbody>


    <?php
    
    foreach ($game['participants'] as $key => $value){
        if ($value['teamId'] == '200'){
            //сделать нормальный массив для имен json'ов для получения советов
            $info = json_decode(file_get_contents('http://ddragon.leagueoflegends.com/cdn/12.9.1/data/' . $_COOKIE['lang'] . '/champion/' .  $champs_name_ava[$value['championId']] . '.json'), true);
        $tips = '';
        foreach ($info['data'][$champs_name_ava[$value['championId']]][$vs[$value['teamId']]] as $ky => $vle){
        $tips .= '<p>' . $vle . '</p>';
        }
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
        $total_masters = array_sum($masters_arr);

        $champs_of_player = ' ';
            /// норм, но много текста, далеко листать для отладки
            for ($n = 0; $n < 3; $n++) {
            $champs_of_player .= '<p>' . $n+1 . ". " . $champs_name_arr[$masters[$n]['championId']] . ": " . number_format($masters[$n]['championPoints'], 0, '', ' ') . "</p>";
            }

            echo '<tr><td><img src="http://ddragon.leagueoflegends.com/cdn/12.9.1/img/profileicon/' . $value['profileIconId'] . '.png"></td>' .
            '<td><a href="full_info.php?nick='. $value['summonerName'] . "&region="  . $_GET['region'] . '">' . $value['summonerName'] . '</td>' .
        
        "<td>" . number_format($total_masters, 0, "", " ") . "</td>". 
        "<td>" . count($masters_arr) . " / " . count($champs_name_json['data']) . "</td>" . 
        "<td>" . $champs_of_player . "</td>" . 
        
        "<td><img src=\"http://ddragon.leagueoflegends.com/cdn/12.9.1/img/champion/" . $ava[$value['championId']] . '">' . "</td>" . 
        
        '<td id="'. $value['championId'] . '">' . $champs_name_arr[$value['championId']] . '</td>' . 
        '<td>' . $tips . '</td></tr>
        
        '
        ;
        }
    }
    echo '</tbody>
    </table>
    </div>';

        // echo $summoner_id;
        // print_r($game);
        echo "<BR>";
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
        // echo "Сыграно на ". count($masters_arr) . " из " . count($champs_name_json['data']);
        // echo "<br><br>";

        // $dif_champ = array_diff_key($all_champs, $masters_arr);
        // if (count($masters_arr) != count($champs_name_json['data'])){
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
        
   

    };
}

include 'footer.php';
?>
