<?php  
include 'header.php';


echo '<h1>'.$lang['Top-h'] . '</h1>';
?>
<div class="form">

    <form action="record_total.php" method="get" name="form">
    <?php 
    include_once 'scripts/region.php';
    include_once 'scripts/queue.php'; 
    include_once 'scripts/amount.php'; ?>
    <!-- <input type="submit"> -->
    <button class="">&#128269;</button>
    <br>
<br>  
<div class="form">

<form action="record_total.php" method="get" name="form">

<?php echo $lang['Nick'];?>: <input name="nick" id="nick" type="text" class="form-control inp" value="<?php if (isset($_GET['nick'])) {echo $_GET['nick'];}?>" placeholder="<?php echo $lang['Nick_ph'];?>">
<?php include 'scripts/region_search.php'; ?>
<button class="btn btn-success btn">&#128269;</button>
</form>
</form>
<script src="scripts/block.js"></script>
</div>
</div>




<?php
include 'api.php';
if (isset($_GET['region'])) {
    include 'scripts/info.php';
    if (isset($_GET['nick']) and $_GET['nick'] != ''){
        $nick = $_GET['nick'];
        $nick_repl = str_replace(' ', '%20', $nick);
        $region_s = $_GET['region_s'];
        $sum_ids = json_decode(
            file_get_contents(
                'json/ids/' . $_GET['region_s'] . '_summoners_ids.json'
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
                    $region_s .
                    '.api.riotgames.com/lol/summoner/v4/summoners/by-name/' .
                    $nick_repl .
                    '?api_key=' .
                    $api
            ),
            true
        );
    }
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
    // $time_start = microtime(true);
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
            echo "<div class=\"sum_place center\"> Призыватель " . $info[$summoner_id][0] . ': ' .  $sum_num+1 . ' <a href="record_total.php' . '?'.$urlParams . $page_summoner . '#' .$sum_num+1  . '">&#8658;</a></div>';
        }
    
        }
        // $time_end = microtime(true);
        // $time = $time_end - $time_start;
        
        // echo "Ничего не делал $time секунд\n";
    include "scripts/nav_top.php";
   

    

echo '<table id="sortable" border="1" >
<thead>
<tr>
<th data-type="number"> № </th>
<th>' . $lang['Nick'] . '</th>          
<th data-type="number">' . $lang['Lvl'] . '</th>
<th data-type="number">' . $lang['Point'] . '</th>
<th>' . $lang['Rang'] . '</th></tr>
</thead>
    <tbody>'
;

for ($ctr; $ctr <= $amount*$page; $ctr++){

    $key = $sum_by_num[$ctr-1];
    if (array_key_exists($sum_by_num[$ctr-1], $info_rang)){
        
        $img =  $add[$info_rang[$key][$l['tier']]] .  '<img src="img/Emblem_' . $info_rang[$key][$l['tier']] . ".png\">";
        if ($info_rang[$key][$l['tier']] == "CHALLENGER" and $info_rang[$key][$l['rank']] == 'I'){
            $elo = $lang[$info_rang[$key][$l['tier']]] . ' ' . $info_rang[$key][$l['lp']];
        }
        else{
            
            $elo = $lang[$info_rang[$key][$l['tier']]] . ' ' . $info_rang[$key][$l['rank']];
        }
    }
    else{
        $img = '&zwnj;&zwnj;';
        $elo = '';
        
    }
     
    if (isset($page_summoner)){
        if ($ctr == $sum_num+1){
        $add_param = ' current';
    }
    else{
        $add_param = '';
    }}
    else{
        $add_param = '';
    }

    echo '<tr class="' . $add_param . '" id="' . $ctr .'"><td>' . $ctr . 
    "</td><td><div class=\"summoner\">
    <img src=\"http://ddragon.leagueoflegends.com/cdn/" . $version . "/img/profileicon/" . $info[$key][$k['icon']] . '.png">
    <a href="full_info.php?nick=' . $info[$key][$k['nick']] . "&region="  . $info[$key][$k['region']] . "\">" .
    '<div class="nick">'  .  
    $info[$key][$k['nick']] .
        '</a><div class="region"> ' .
        $info[$key][$k['region']] .
        '</div></div></td><td>'.
        
        $info[$key][$k['lvl']].
        '</td><td>' . 
        number_format($summoners[$key], 0, '', '&nbsp;') .
        // $value .
        '</td><td>' . '<div class="rank">' .
        $img .
        '<div class="elo">' .  $elo .   
        '</div></div>' 
        .
        '</td></tr>';
        
    if (isset($_GET['amount'])) {
        if ($ctr == count($sum_by_num)) {
            break;
        }
    }
}
echo '</tbody></table>';


include "scripts/nav_bot.php";
    
}


include 'footer.php';
?>
