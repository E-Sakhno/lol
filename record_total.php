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
</form>


<?php
if (isset($_GET['region'])) {
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
    // // print_r  (array_count_values($sum_by_num)) ;
    // echo '<B>' .  count($sum_by_num) . ' </B>';
    // echo '<B>' .  count($summoners) . ' </B>';
    // echo '<B>' .  count($info) . ' </B>';
    // echo "<BR>";
    // echo "<BR>";
    // print_r ($summoners);
    echo "<BR>";
    echo "<BR>";
    // print_r($sum_by_num);

    $champs_name = json_decode(
            file_get_contents('json/'. $_COOKIE['lang'] . '_champs_name.json'),
            true,
            JSON_UNESCAPED_UNICODE
        );
    // print_r($champs_name);

    echo '<table id="sortable" border="1" >
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
    
    if (isset($_GET['p'])){

        $page = $_GET['p'];
    }
    else{
        $page = 1;
    }

    $ctr = 1 +  $_GET['amount'] * ($page-1);
    // echo $page;
    // print_r($info[$key]);
    for ($ctr; $ctr <= $_GET['amount']*$page; $ctr++){

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
        <img src=\"http://ddragon.leagueoflegends.com/cdn/12.8.1/img/profileicon/" . $info[$key][$k['icon']] . '.png">
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
    
    $urlParams = '&region=' . $_GET['region'] . '&qu=' . $_GET['qu'] . '&amount=' . $_GET['amount'] . '&p=';
    echo '<div class="pages">';
    if ($page > 1){

        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page-1 . '"> < </a></div>';
    }
    for ($n=1; $n <= ceil(count($sum_by_num)/$_GET['amount']); $n++){
        $url = $urlParams . $n;
        if ($n == $page){
            $cur = 'current';
        }
        else{
            $cur = '';
        }
        echo '<div class="pagenum ' .$cur. '"><a href="record_total.php?'. $url . '">' . $n . " </a></div>";
    }
    if ($page < ceil(count($sum_by_num)/$_GET['amount'])){

        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page+1 . '"> > </a></div>';
    }
    echo "</div>";
    // echo ceil(count($sum_by_num)/$_GET['amount']);

}


include 'footer.php';
?>
