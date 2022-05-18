<?php  
include 'header.php';


echo '<h1>'.$lang['Top-h'] . '</h1>';
?>

    <form action="record_total.php" method="get" name="form">
    <?php 
    include_once 'scripts/region.php';
    include_once 'scripts/queue.php'; 
    include_once 'scripts/amount.php'; ?>
    <!-- <input type="submit"> -->
    <button class="btn btn-success btn">&#128269;</button>
    <br>
<br>    
<form action="record_total.php" method="get" name="form">

Nick: <input name="nick" type="text" class="form-control inp" value="<?php if (isset($_GET['nick'])) {echo $_GET['nick'];}?>" placeholder="Введите ник">
<?php include 'scripts/region_search.php'; ?>
<button class="btn btn-success btn">&#128269;</button>
</form>
</form>




<?php
include 'api.php';
if (isset($_GET['region'])) {
    include 'scripts/info.php';
    if (isset($_GET['nick']) and $_GET['nick'] != ''){
        $nick = $_GET['nick'];
        $nick_repl = str_replace(' ', '%20', $nick);
        $region_s = $_GET['region_s'];
        $summoner_info = json_decode(
            file_get_contents(
                'https://' .
                    $region_s .
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
        global $summoner_id;
        $summoner_id = $summoner_info['id'];
                
        $sum_num = array_key_exists($summoner_id, $info);
        // echo $summoner_id;
        // print_r ($info);
        // echo $sum_num;
        if ($sum_num == 0){
            // echo 'не нашли';
            include "scripts/sum_info.php";
            unset($info);
            include 'scripts/info.php';
         }}
        }


    // print_r($info_rang);
    $summoners = [];
    foreach ($info as $key => $row) {
        $summoners[$key] = $row[$k['total']];
    }
    array_multisort($summoners, SORT_DESC, $info);
    $counter = 0;
    $sum_by_num = [];
    foreach ($summoners as $key => $value){
        $sum_by_num[$counter] = $key;
        $counter++;

    }
    
    // // print_r  (array_count_values($sum_by_num)) ;
    // echo '<B>' .  count($sum_by_num) . ' </B>';
    // echo '<B>' .  count($summoners) . ' </B>';
    // echo '<B>' .  count($info) . ' </B>';
    // echo "<BR>";
    // echo "<BR>";
    // print_r ($summoners);
    // echo "<BR>";
    // echo "<BR>";
    // print_r($sum_by_num);

    $champs_name = json_decode(
            file_get_contents('json/'. $_COOKIE['lang'] . '_champs_name.json'),
            true,
            JSON_UNESCAPED_UNICODE
        );
    // print_r($champs_name);

//    echo "KEY: ";
//    (print_r($sum_num));
    //    echo $sum_num;
    // if (isset($_GET['nick']) and $_GET['nick'] != ''){
        
    
    // }



    include "scripts/nav_var.php";

    if (isset($_GET['nick']) and $_GET['nick'] != ''){

        $sum_num = array_search($summoner_id, $sum_by_num);
        $page_summoner = ceil(($sum_num+1)/$amount);
        if ($sum_num !=0){
            echo "Призыватель " . $summoner_info['name'] . ': ' .  $sum_num+1 . ' <a href="record_total.php' . '?'.$urlParams . $page_summoner . '#' .$sum_num+1  . '">&#8658;</a>';
        }
    
        }

    include "scripts/nav_top.php";

    

echo '<br><br><table id="sortable" border="1" >
<thead>
<tr>
<th data-type="number"> № </th>
<th> Ник </th>          
<th data-type="number"> Лвл </th>
<th data-type="number"> Очки </th>
<th> Ранг </th></tr>
</thead>
    <tbody>'
;

include "scripts/nav_bot.php";
    
}


include 'footer.php';
?>
