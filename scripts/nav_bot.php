<?php

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
?>
