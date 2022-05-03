<form action="test.php" method="get" name="form">
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


<script src="scripts/show_more.js"></script>

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
                'http://ddragon.leagueoflegends.com/cdn/12.8.1/data/ru_RU/champion.json' .
                '?api_key=' .
                $api
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
        
        file_put_contents('json/champs_name.json', json_encode($champs_name_arr, JSON_UNESCAPED_UNICODE));
         



        echo "<br>";
        echo "Сыграно на ". count($masters_arr) . " из " . count($champs_name_json['data']);
        echo "<br><br>";

        $dif_champ = array_diff_key($all_champs, $masters_arr);
        if (count($masters_arr) != count($champs_name_json['data'])){
            echo "<br>Не сыграно на: <br>";

        }
        foreach ($dif_champ as $key => $value){
           echo $value." ";
            
        }
       
        echo "<br><br>";
    //     echo '<table border="1" >     <tr>
    // <td> № </td>         
    // <td> Герой </td>          
    // <td> Очки  </td></tr>';
            
            $champs_of_player = [];
            /// норм, но много текста, далеко листать для отладки
            for ($n = 0; $n < count($masters); $n++) {
            echo $n + 1 . '. ' .$champs_name_arr[$masters[$n]['championId']]. " " . $masters[$n]['championPoints'] . "<br>\r\n";
            // echo "<tr><td>". $n + 1 . '</td><td> ' .$champs_name_arr[$masters[$n]['championId']]. "</td><td>" . $masters[$n]['championPoints'] . "</td><tr>";
            
            if ($n == 4){
                echo '  <div id="more" style="display: none;"> ';
            }
        }
        echo '</div><br><a href="javascript:void(0)" onclick="show(\'more\')">Все герои</a>';
        

        
        $summoners_top = json_decode(file_get_contents('json/'.$_GET['region'].'_summoners_arr.json'), true);
        // echo "Начальный массив <br>";
       
    //    echo is_array($summoners_top);
       
        $summoners_top[$summoner_id] = array(
            "nick" => $nick, 
            "region" => $_GET['region'],
            "total" => $total_masters, 
            "count_champs" => count($masters_arr), 
            "min_key" => array_key_last($masters_arr), 
            "min_point" => $masters_arr[array_key_last($masters_arr)], 
            "max_key" => array_key_first($masters_arr), 
            "max_point" => $masters_arr[array_key_first($masters_arr)], 
            "7" => array_count_values(array_column($masters, 'championLevel'))[7], 
            "6" => array_count_values(array_column($masters, 'championLevel'))[6],
            "5" => array_count_values(array_column($masters, 'championLevel'))[5],
            "4" => array_count_values(array_column($masters, 'championLevel'))[4],
            "3" => array_count_values(array_column($masters, 'championLevel'))[3],
            "2" => array_count_values(array_column($masters, 'championLevel'))[2],
            "1" => array_count_values(array_column($masters, 'championLevel'))[1]
        ); 
        // echo "<br><br>";
        // echo "Преобразованный массив <br>";
        // var_dump($summoners_top);
        // print_r ($summoners_top[$summoner_id]);

        file_put_contents('json/'.$_GET['region'].'_summoners_arr.json', json_encode($summoners_top, true));
                

    };
}

?>
