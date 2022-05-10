<p>
    Топ по очкам на героях

    <form action="record_max.php" method="get" name="form">
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
    // print_r($info);
    $summoners = [];
    foreach ($info as $key => $row) {
        $summoners[$key] = $row[$k['max_point']];
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

    echo '<table border="1" >     <tr>   
    <td> № </td>         
    <td> Ник </td>
    <td> Регион </td>
    <td> Очки </td>
    <td> Чемпион </td></tr>';

    $ctr = 1;

    // print_r($info[$key]);
    foreach ($summoners as $key => $value) {
        echo '<tr><td>' . $ctr . "</td><td><a href='full_info.php?nick=" . $info[$key][$k['nick']] . "&region="  . $info[$key][$k['region']] . "'>" . $info[$key][$k['nick']].'</td><td>'.$info[$key][$k['region']].'</td><td>'. number_format($value, 0, "", " ")."</td><td>".$champs_name[$info[$key][$k['max_key']]]."</td></tr>";
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
