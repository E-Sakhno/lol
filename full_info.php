<link rel="stylesheet" href="style/total.css">
<form action="full_info.php" method="get" name="form">
    Nick: <input name="nick" type="text" class="form-control inp" value="" placeholder="
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




<?php 

    if (isset($_GET['nick'])) {
        echo 'Имя призывателя: ' . $_GET['nick'] . '<br>';
        echo 'Регион: ' . $_GET['region'] . '<br>';
        
        include 'api.php';
        $nick = $_GET['nick'];
        $region = $_GET['region'];
        $summoner_info = json_decode(
            file_get_contents(
                'https://' .
                $region .
                '.api.riotgames.com/lol/summoner/v4/summoners/by-name/' .
                $nick .
                    '?api_key=' .
                    $api
                ),
                true
            );
            
            
        if ($summoner_info == NULL){
            echo "Такого пользователя не найдено!";
        }
        else{
            $summoner_id = $summoner_info['id'];
            
            $rank = json_decode(
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
        // [queueType] => RANKED_FLEX_SR
        $num_rank = 0;
        foreach ($rank as $key => $value){
            if ($value['queueType'] == 'RANKED_SOLO_5x5'){
                break;
            }
            // print_r ($value['queueType']);
            $num_rank++;
        }
        // echo $num_rank;

          echo "<BR>";
        //   print_r ($rank);
          $add = ["IRON" => "", 
          "BRONZE" => "&shy;", 
          "SILVER" =>  "&shy;", 
          "GOLD" => "&shy;&shy;", 
          "PLATINUM" =>  "&shy;&shy;", 
          "DIAMOND" => "&zwnj;", 
          "MASTER" => "&zwnj;", 
          "GRANDMASTER" => "&zwnj;&zwnj;", 
          "CHALLENGER" => "&zwnj;&zwnj;&zwnj;", 
          "-" => ''];
          if (empty($rank)){
              $elo = "-";
          }
          else{

              $elo = $rank[$num_rank]['tier'];
          }
        //   echo empty($rank);
        echo '<img src="http://ddragon.leagueoflegends.com/cdn/12.8.1/img/profileicon/' . $summoner_info['profileIconId'] . '.png">';
          
          echo "<BR>";

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

        // print_r($masters);
        // echo (array_count_values(array_column($masters, 'championLevel'))[7]);
        $masters_arr = [];
        for ($i = 0; $i < count($masters); $i++) {
            $masters_arr[$masters[$i]['championId']] =
                $masters[$i]['championPoints'];
        }
        $total_masters = array_sum($masters_arr);

        echo "Всего очков на чемпионах: ". number_format($total_masters, 0, "", " ");
        
        $champs_name_json = json_decode(
            file_get_contents(
                'json/'. $_COOKIE['lang'] . '_champs.json'),
            true
        );
        
        $ava = json_decode(
            file_get_contents(
                'json/ava_champs.json'),
            true
        );


        // print_r (($champs_name_json)['key']);
        $champs_name_arr = json_decode(
            file_get_contents(
                'json/'. $_COOKIE['lang'] . '_champs_name.json'
            ),
            true
        );;
        // echo  count($champs_name_json['data']);
       foreach ($champs_name_json['data'] as $key => $value){
            $champs_name_arr[$value['key']] =
            $value['name'];
                        
        }
       

        echo "<br>";
        echo "Сыграно на ". count($masters_arr) . " из " . count($champs_name_json['data']);
        echo "<br><br>";
        
        $dif_champ = array_diff_key($champs_name_arr, $masters_arr);
        if (count($masters_arr) != count($champs_name_json['data'])){
            echo "<br>Не сыграно на: <br>";

        }
        
        if (array_key_exists(777, $dif_champ)){
            if ($dif_champ[777] == "Ёнэ"){
            $dif_champ[777] = "Енэ";}
        };
        asort($dif_champ);
        if (array_key_exists(777, $dif_champ)){
            if ($dif_champ[777] == "Енэ"){
                $dif_champ[777] = "Ёнэ";}
        };
        // print_r($dif_champ);
        foreach ($dif_champ as $key => $value){
           echo $value." ";
            
        }
        $last_play = [];
        foreach ($masters as $key => $row) {
            // echo $masters[$key]['championId'].' ';
            $last_play[$masters[$key]['championId']] = $row['lastPlayTime'];
        }
        asort($last_play);
        // echo $last_play[array_key_first($last_play)];
        // array_multisort($last_play, SORT_ASC, $masters);
       
        echo "<br><br>";
        // print_r ($masters);
        // print_r ($last_play);
        echo '<div class="blok"> 
        <table id="sortable" border="1" >     
        
        <thead>
        <tr>
        <th data-type="number"> № </th>         
        <th> Ava </th>          
        <th> Герой </th>          
    <th data-type="number"> Очки  </th>
    <th data-type="number"> Ранг  </th>
    <th> Последний раз сыграно  </th>
    <th> Сундук  </th>
    <th > Жетонов в инвентаре </th>
    </tr>
    </thead>
    <tbody>
    
    
    '
    ;
            // print_r ($masters);
            $champs_of_player = [];
            /// норм, но много текста, далеко листать для отладки
            for ($n = 0; $n < count($masters); $n++) {
            echo  
            "<tr><td>" . 
            $n + 1 . 
            "</td><td>" .
            "<img src=\"http://ddragon.leagueoflegends.com/cdn/12.8.1/img/champion/" . $ava[$masters[$n]['championId']] . '">' .
            "</td><td id=\"" . $masters[$n]['championId'] . "\">" . 
            $champs_name_arr[$masters[$n]['championId']] . 
            "</td><td>" .
            number_format($masters[$n]['championPoints'], 0, "", " ") .
            
            "</td><td>" .
            $masters[$n]['championLevel'] .
            
            "</td><td>" .
            gmdate("Y.m.d H:i", $masters[$n]['lastPlayTime']/1000) . 
            "</td><td>" .
            str_replace(1, '+', $masters[$n]["chestGranted"]) .
            "</td><td>" .
            
            str_replace(0, '',  $masters[$n]["tokensEarned"]) .
            "</td></tr>";
            }
        
         echo "</tbody></table></div>";           
        $summoners_top = json_decode(file_get_contents('json/'.$_GET['region'].'_summoners_arr.json'), true);
        // echo "Начальный массив <br>";
       
    //    echo is_array($summoners_top);
       
        $summoners_top[$summoner_id] = array(
            $nick, 
            $_GET['region'],
            $summoner_info['profileIconId'],
            $summoner_info['summonerLevel'],
            $elo,
            $total_masters, 
            count($masters_arr), 
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
            $rank[$num_rank]['rank'],
            $add[$rank[$num_rank]['tier']]
        ); 

        file_put_contents('json/'.$_GET['region'].'_summoners_arr.json', json_encode($summoners_top, JSON_UNESCAPED_UNICODE));
                

    };
}

?>


<script src="scripts/show_more.js"></script>
<script src="scripts/sorting.js"></script>