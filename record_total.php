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
<form action="record_total.php?" method="get" name="form">
Nick: <input name="nick" type="text" class="form-control inp" value="" placeholder="">
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
         }}
         unset($info);
    include 'scripts/info.php';



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
    $sum_num = array_search($summoner_id, $sum_by_num);

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
        if ($sum_num !=0){
        echo "Призыватель " . $summoner_info['name'] . ': ' .  $sum_num+1;
        }
}


    $amount = ceil(str_replace(',', '.', $_GET['amount']));

    if (isset($_GET['p'])){

        $page = ceil(str_replace(',', '.', $_GET['p']));
    }
    else{
        $page = 1;
    }

    
    $ctr = 1 +  $amount * ($page-1);
    // echo $page;
    // print_r($info[$key]);
    $urlParams = '&region=' . $_GET['region'] . '&qu=' . $_GET['qu'] . '&amount=' . $amount . '&nick=' . $nick . "&region_s=" . $region_s. '&p=';
    $page_last = ceil(count($sum_by_num)/$amount);

    if ($page_last <=6){
    echo '<div class="pages">';
    if ($page != 1){
        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page-1 . '"> < </a></div>';

    }

        for ($n=1; $n<=$page_last; $n++){
            $url = $urlParams . $n;
        if ($n == $page){
            $cur = ' current';
        }
        else{
            $cur = '';
        }
        echo '<div class="pagenum' .$cur. '"><a href="record_total.php?'. $url . '">' . $n . " </a></div>";

    }
    if ($page != $page_last){
        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page+1 . '"> > </a></div>';

    }
    
}
    else{
    if ($amount > 10){
    echo '<div class="pages">';
    if ($page > 1){

        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page-1 . '"> < </a></div>';
    }

    if ($page >= 5 and $page_last >= 7 and $page < $page_last - 3){
        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . 1 . '"> 1 </a></div>';
        echo '<div class="pagenum">...</div>';
        for ($n=$page-2; $n<=$page+2; $n++){
            $url = $urlParams . $n;
        if ($n == $page){
            $cur = ' current';
        }
        else{
            $cur = '';
        }
        echo '<div class="pagenum' .$cur. '"><a href="record_total.php?'. $url . '">' . $n . " </a></div>";

        
    }
    echo '<div class="pagenum">...</div>';
    echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page_last . '">' . $page_last . " </a></div>";

    }
    else{

        if ($page < 5){


    for ($n=1; $n <= 5; $n++){
        $url = $urlParams . $n;
        if ($n == $page){
            $cur = ' current';
        }
        else{
            $cur = '';
        }
        echo '<div class="pagenum' .$cur. '"><a href="record_total.php?'. $url . '">' . $n . " </a></div>";
    }
    echo '<div class="pagenum">...</div>';
    echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page_last . '">' . $page_last . " </a></div>";

    }
    else{
        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . 1 . '"> 1 </a></div>';
        echo '<div class="pagenum">...</div>';
        for ($n=$page_last-4; $n<=$page_last; $n++){
            $url = $urlParams . $n;
        if ($n == $page){
            $cur = ' current';
        }
        else{
            $cur = '';
        }
        echo '<div class="pagenum' .$cur. '"><a href="record_total.php?'. $url . '">' . $n . " </a></div>";
    
    }
    }
    }






    if ($page < ceil(count($sum_by_num)/$amount)){

        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page+1 . '"> > </a></div>';
    }
    echo "</div>";
}

    // echo ceil(count($sum_by_num)/$_GET['amount']);

}

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


    for ($ctr; $ctr <= $amount*$page; $ctr++){

        $key = $sum_by_num[$ctr-1];
        if (array_key_exists($sum_by_num[$ctr-1], $info_rang)){
            
            $img =  $add[$info_rang[$key][$l['tier']]] .  '<img src="img/Emblem_' . $info_rang[$key][$l['tier']] . ".png\">";
            if ($info_rang[$key][$l['tier']] == "CHALLENGER" and $info_rang[$key][$l['rank']] == 'I'){
                $elo = $info_rang[$key][$l['tier']] . ' ' . $info_rang[$key][$l['lp']];
            }
            else{
                
                $elo = $info_rang[$key][$l['tier']] . ' ' . $info_rang[$key][$l['rank']];
            }
        }
        else{
            $img = '&zwnj;&zwnj;';
            $elo = '';
            
        }
    
        echo '<tr><td>' . $ctr . 
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
            number_format($summoners[$key], 0, ',', ' ') .
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


    if ($page_last <=6){
        echo '<div class="pages">';
        if ($page != 1){
            echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page-1 . '"> < </a></div>';
    
        }
    
            for ($n=1; $n<=$page_last; $n++){
                $url = $urlParams . $n;
            if ($n == $page){
                $cur = ' current';
            }
            else{
                $cur = '';
            }
            echo '<div class="pagenum' .$cur. '"><a href="record_total.php?'. $url . '">' . $n . " </a></div>";
    
        }
        if ($page != $page_last){
            echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page+1 . '"> > </a></div>';
    
        }
        
    }
        else{
        echo '<div class="pages">';
        if ($page > 1){
    
            echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page-1 . '"> < </a></div>';
        }
    
        if ($page >= 5 and $page_last >= 7 and $page < $page_last - 3){
            echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . 1 . '"> 1 </a></div>';
            echo '<div class="pagenum">...</div>';
            for ($n=$page-2; $n<=$page+2; $n++){
                $url = $urlParams . $n;
            if ($n == $page){
                $cur = ' current';
            }
            else{
                $cur = '';
            }
            echo '<div class="pagenum' .$cur. '"><a href="record_total.php?'. $url . '">' . $n . " </a></div>";
    
            
        }
        echo '<div class="pagenum">...</div>';
        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page_last . '">' . $page_last . " </a></div>";
    
        }
        else{
    
            if ($page < 5){
    
    
        for ($n=1; $n <= 5; $n++){
            $url = $urlParams . $n;
            if ($n == $page){
                $cur = ' current';
            }
            else{
                $cur = '';
            }
            echo '<div class="pagenum' .$cur. '"><a href="record_total.php?'. $url . '">' . $n . " </a></div>";
        }
        echo '<div class="pagenum">...</div>';
        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page_last . '">' . $page_last . " </a></div>";
    
        }
        else{
            echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . 1 . '"> 1 </a></div>';
            echo '<div class="pagenum">...</div>';
            for ($n=$page_last-4; $n<=$page_last; $n++){
                $url = $urlParams . $n;
            if ($n == $page){
                $cur = ' current';
            }
            else{
                $cur = '';
            }
            echo '<div class="pagenum' .$cur. '"><a href="record_total.php?'. $url . '">' . $n . " </a></div>";
        
        }
        }
        }
    
    
    
    
    
    
        if ($page < ceil(count($sum_by_num)/$amount)){
    
            echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page+1 . '"> > </a></div>';
        }
        echo "</div>";
    
    
        // echo ceil(count($sum_by_num)/$_GET['amount']);
    
    }
    
}


include 'footer.php';
?>
