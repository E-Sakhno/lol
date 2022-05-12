<p>
    Топ по очкам на героях в сумме

    <form action="record_total.php" method="get" name="form">
    <?php include_once 'scripts/region.php'; ?>
    <br>
    Количество записей: 
    <?php include_once 'scripts/amount.php'; ?>
<br><br>    
    <!-- <input type="submit"> -->
    <button class="btn btn-success btn">Кнопка</button>
</form>

</p>

<?php
include 'header.php';
if (isset($_GET['region'])) {
    include 'scripts/info.php';
    // print_r($info_rang);
    $summoners = [];
    foreach ($info as $key => $row) {
        $summoners[$key] = $row[$k['total']];
    }
    array_multisort($summoners, SORT_DESC, $info);
    // echo "<BR>";
    // echo "<BR>";
    // print_r ($summoners);

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
    <th> Регион </th>         
    <th data-type="number"> Лвл </th>
    <th data-type="number"> Очки </th>
    <th> Ранг </th></tr>
    </thead>
        <tbody>'
    ;

    $ctr = 1;
    // print_r($info[$key]);
    foreach ($summoners as $key => $value) {
        if (array_key_exists($key, $info_rang)){
            $img = $info_rang[$key][$l['add']]. '<img src="img/Emblem_' . $info_rang[$key][$l['tier']] . ".png\">";
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
    
        echo '<tr><td>' . $ctr . 
        "</td><td>
        <img src=\"http://ddragon.leagueoflegends.com/cdn/12.8.1/img/profileicon/" . $info[$key][$k['icon']] . '.png">
        <a href="full_info.php?nick=' . $info[$key][$k['nick']] . "&region="  . $info[$key][$k['region']] . "\">" .
            $info[$key][$k['nick']] .
            '</a></td><td>' .
            $info[$key][$k['region']] .
            '</td><td>'.
            $info[$key][$k['lvl']].
            '</td><td>' . 
            number_format($value, 0, ',', ' ') .
            // $value .
            '</td><td>' . 
            $img .
            $elo .   
            '</td></tr>';
            
            $ctr++;
        if (isset($_GET['amount'])) {
            if ($ctr > $_GET['amount']) {
                break;
            }
        }
    }
    echo '</table>';
}


include 'footer.php';
?>
