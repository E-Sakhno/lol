<p>
    Топ по количеству
    <?php
    $numb = ["seven" => 7, "six" => 6];
if (isset($_GET['rang'])){
    echo $numb[$_GET['rang']];
}

?>
     рангов

    <form action="record_rang.php" method="get" name="form">
    Rang: <select name="rang">
    <option value="seven"> 7
    <option value="six"> 6
    </select><br><br>

    Region: <select name="region">
    <option value="all"> All
    <option value="ru"> Ru
    <option value="euw1"> EuW
    </select><br><br> 
    Количество записей: <select name="amount">
        <option value="10"> 10
            <option value="50"> 50
    <option value="100"> 100
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
        $summoners[$key] = $row['count_'.$_GET['rang']];
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

    echo '<table border="1" >     <tr>
    <td> № </td>         
    <td> Ник </td>          
    <td> Регион </td>         
    <td> Количество  </td></tr>';

    $ctr = 1;
    // print_r($info[$key]);
    foreach ($summoners as $key => $value) {
        echo '<tr><td>' .
            $ctr .
            '</td><td>' .
            $info[$key]['nick'] .
            '</td><td>' .
            $info[$key]['region'] .
            '</td><td>' .
            $value .
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

?>
