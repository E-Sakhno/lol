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
if (isset($_GET['region'])) {
    include 'scripts/info.php';
    // print_r($info);
    $summoners = [];
foreach ($info as $key => $row)
{
    $summoners[$key] = $row['min_point'];
}
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
        <td> Очки </td>
        <td> Чемпион </td>
        ';


        $ctr = 1;
foreach ($summoners as $key => $value){
    echo "<tr><td>" . $ctr . "</td><td><a href='test.php?nick=" . $info[$key]['nick'] . "&region="  . $info[$key]['region'] . "'>" . $info[$key]['nick'].'</td><td>'.$info[$key]['region'].'</td><td>'.$value."</td><td>".$champs_name[$info[$key]['min_key']]."</td></tr>";
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