<p>
    Топ по очкам на героях в сумме

    <form action="record_total.php" method="get" name="form">
    Region: <select name="region">
    <option value="all"> All
    <option value="ru"> Ru
    <option value="euw1"> EuW
    </select><br><br>    
    <!-- <input type="submit"> -->
    <button class="btn btn-success btn">Кнопка</button>
</form>

</p>

<?php if (isset($_GET['region'])) {
    include 'scripts/info.php';
    // print_r($info);
    $summoners = [];
    foreach ($info as $key => $row) {
        $summoners[$key] = $row['total'];
    }
    array_multisort($summoners, SORT_DESC, $info);
    // echo "<BR>";
    // echo "<BR>";
    // print_r ($summoners);

    $champs_name = json_decode(
        file_get_contents('json/champs_name.json'),
        true,
        JSON_UNESCAPED_UNICODE
    );
    // print_r($champs_name);

    echo '<table border="1" >     <tr>         <td> Ник </td>          <td> Регион </td>         <td> Очки </td></tr>';

    // print_r($info[$key]);
    foreach ($summoners as $key => $value) {
        echo '<tr><td>' .
            $info[$key]['nick'] .
            '</td><td>' .
            $info[$key]['region'] .
            '</td><td>' .
            number_format($value, 0, ',', ' ') .
            '</td></tr>';
    }
    echo '</table>';
}

?>
