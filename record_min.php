<p>
    Антитоп по очкам на героях

    <form action="record_min.php" method="get" name="form">
    <?php include_once 'scripts/region.php'; ?>
    <br>
     Количество записей: 
    <?php include_once 'scripts/amount.php'; ?>
    <br><br>  
<br><br>    
    <!-- <input type="submit"> -->
    <button class="btn btn-success btn">Кнопка</button>
</form>

</p>

<?php 
include 'header.php';
if (isset($_GET['region'])) {
    include 'scripts/info.php';
    // print_r($info);
    $summoners = [];
foreach ($info as $key => $row)
{
    $summoners[$key] = $row[$k['min_point']];
}
array_multisort($summoners, SORT_ASC, $info);
// echo "<BR>";
// echo "<BR>";
// print_r ($summoners);

$champs_name = json_decode(
    file_get_contents('json/'. $_COOKIE['lang'] . '_champs_name.json'),
    true,
    JSON_UNESCAPED_UNICODE
);
// print_r($champs_name);

echo '
<div>
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
foreach ($summoners as $key => $value){
    if ($info[$key][$k['elo']] != '-'){

        $img = '<img src="img/Emblem_' . $info[$key][$k['elo']] . ".png\">";
    }
    else{
        $img = '';
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
        '</td><td>' . $info[$key][$k['add']]. $img .
        $info[$key][$k['elo']] . ' ' . $info[$key][$k['rank']] .  
        
    '</td><td>'.
    $value."</td><td>".
    $champs_name[$info[$key][$k['min_key']]].
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