<?php
include 'header.php';

// $mln = json_decode(
//     file_get_contents(
//         'json/mln/ru_summoners_mln.json'
//     ),
//     true
// );
// print_r ($mln);
?>
<p>
    Топ миллионщиков

    <form action="millions.php" method="get" name="form">
    <?php 
    include_once 'scripts/region.php';
    include_once 'scripts/queue.php'; 
    include_once 'scripts/amount.php'; ?>
    <br><br>    
    <!-- <input type="submit"> -->
    <button class="btn btn-success btn">Кнопка</button>
</form>

</p>

<?php 
include 'header.php';
if (isset($_GET['region'])) {
    include 'scripts/info_mln.php';
    include 'scripts/info.php';

    // print_r($mln);
    
    $summoners_millions = [];
    foreach ($mln as $key => $row) {
        foreach ($row as $ky => $value){
           array_push($summoners_millions, [$value, $ky, $key]);
        }
        // $summoners[$key] = $row[$k['max_point']];
    }
    arsort($summoners_millions);
    print_r ($summoners_millions);

    // array_multisort($summoners, SORT_DESC, $info);
    // echo "<BR>";
    // echo "<BR>";
    // print_r ($summoners);
    
    $champs_name = json_decode(
        file_get_contents('json/'. $_COOKIE['lang'] . '_champs_name.json'),
        true,
        JSON_UNESCAPED_UNICODE
    );
    // print_r($champs_name);

    echo '<div>
    <table id="sortable" border="1" >     
    <thead>
    
        <tr>
            <th data-type="number"> № </th>
            <th> Ник </th>
            <th> Регион </th>
            <th data-type="number"> Уровень </th>
            <th> Эло </th>
            <th data-type="number"> Очки </th>
            <th> Чемпион </th>
            </tr>
            </thead>
            <tbody>
            
            ';
    
    $ctr = 1;

    // print_r($info[$key]);
    $ctr = 1;
    foreach ($summoners_millions as $ky => $value){
        $key = $value[2];
        if (array_key_exists($key, $info_rang)){
            $img = $add[$info_rang[$key][$l['tier']]]. '<img src="img/Emblem_' . $info_rang[$key][$l['tier']] . ".png\">";
            if ($info_rang[$key][$l['tier']] == "CHALLENGER" and $info_rang[$key][$l['rank']] == 'I'){
                $elo = $info_rang[$key][$l['tier']] . ' ' . $info_rang[$key][$l['lp']];
            }
            else{
                
                $elo = $info_rang[$key][$l['tier']] . ' ' . $info_rang[$key][$l['rank']];
            }
        }
        else{
            $img = '';
            $elo = '&zwnj;&zwnj; - ';
            
        }
    
        echo "<tr><td>" . 
            $ctr . 
            "</td><td><img src=\"http://ddragon.leagueoflegends.com/cdn/12.8.1/img/profileicon/" . $info[$key][$k['icon']] . '.png">'.    
            "<a href='full_info.php?nick=" . $info[$key][$k['nick']] . "&region="  . $info[$key][$k['region']] . "'>" . 
            $info[$key][$k['nick']].
            '</a></td><td>'.
            $info[$key][$k['region']].
            '</td><td>'.
            $info[$key][$k['lvl']].
            '</td><td>' . 
             $img .
            $elo .  
            
        '</td><td>'.
        number_format($value[0], 0, '', '&nbsp;') ."</td><td>".
        $champs_name[$value[1]].
        "</td></tr>";
        $ctr++;
            if (isset($_GET['amount'])) {
                if ($ctr > $_GET['amount']) {
                    break;
                }
            }
    }
    
    echo "</tbody></table></div>";     
    
    }
    
    include 'footer.php';
    ?>