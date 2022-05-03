<p>
    Антитоп по времени игры на героях

    <form action="record_early.php" method="get" name="form">
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
if (isset($_GET['region'])) {
    include 'scripts/info.php';
    // print_r($info);
    $summoners = [];
foreach ($info as $key => $row)
{
    $summoners[$key] = $row['early_point'];
}

// print_r($summoners);
array_multisort($summoners, SORT_ASC, $info);
// echo "<BR>";
// echo "<BR>";
// print_r ($summoners);

$champs_name = json_decode(file_get_contents('json/champs_name.json'), true,  JSON_UNESCAPED_UNICODE);
// print_r($champs_name);

echo '
<table border="1" >
    <tr>
        <td> № </td>
        <td> Ник </td>
        <td> Регион </td>
        <td> Время </td>
        <td> Чемпион </td>
        ';


        $ctr = 1;
foreach ($summoners as $key => $value){
    echo "<tr><td>" . 
    $ctr . 
    "</td><td><a href='full_info.php?nick=" .     $info[$key]['nick'] .     "&region="  .     $info[$key]['region'] . "'>" . 
    $info[$key]['nick'].
    '</td><td>'.
    $info[$key]['region'].
    '</td><td>'.
    gmdate("Y.m.d H:i", $value/1000).
    "</td><td>".$champs_name[$info[$key]['early_key']]."</td></tr>";
    $ctr++;
        if (isset($_GET['amount'])) {
            if ($ctr > $_GET['amount']) {
                break;
            }
        }
}

echo '</table>';
}
?>