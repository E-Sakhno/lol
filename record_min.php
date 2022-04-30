<p>
    Антитоп по очкам на героях

    <form action="record_min.php" method="get" name="form">
    Region: <select name="region">
    <option value="all"> All
    <option value="ru"> Ru
    <option value="euw1"> EuW
    </select><br><br>    
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
        <td> Ник </td>
        <td> Регион </td>
        <td> Очки </td>
        <td> Чемпион </td>
        ';


foreach ($summoners as $key => $value){
    echo "<tr><td>".$info[$key]['nick'].'</td><td>'.$info[$key]['region'].'</td><td>'.$value."</td><td>".$champs_name[$info[$key]['min_key']]."</td></tr>";

}

echo '</table>';
}
?>