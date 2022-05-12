<p>
    Топ по винрейту
    <?php
if (isset($_GET['qu'])){
    echo $_GET['qu'];
}

?>
     рангов

    <form action="record_rank_winrate.php" method="get" name="form">
    Очередь: <select name="qu">
    <option value="solo"> Соло
    <option value="flex" 
    <?php if (isset($_GET['qu'])){if ($_GET['qu'] == 'flex'){echo 'selected';}} ?> > Флекс
    <option value="tft"
    <?php if (isset($_GET['qu'])){if ($_GET['qu'] == 'tft'){echo 'selected';}} ?> > Тфт
    </select><br><br>

    <?php include_once 'scripts/region.php'; ?>
    <br><br>

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
    foreach ($info_rang as $key => $row) {
        $summoners[$key] = $row[$l['wins']] / ($row[$l['wins']] + $row[$l['losses']]) * 100;
    }
    array_multisort($summoners, SORT_DESC, $info_rang);

    // $champs_name = json_decode(
    //     file_get_contents('json/'. $_COOKIE['lang'] . '_champs_name.json'),
    //     true,
    //     JSON_UNESCAPED_UNICODE
    // );
    // // print_r($champs_name);

    echo '<table border="1" >     <tr>
    <td> № </td>         
    <td> Ник </td>          
    <td> Регион </td>         
    <td> Побед  </td></tr>';

    $ctr = 1;
    // print_r($info[$key]);
    foreach ($summoners as $key => $value) {
        echo '<tr><td>' .
            $ctr .
            "</td><td><a href='full_info.php?nick=" . $info[$key][$k['nick']] . "&region="  . $info[$key][$k['region']] . "'>" .

            $info[$key][$k['nick']] .
            '</td><td>' .
            $info[$key][$k['region']] .
            '</td><td>' .
            number_format($value, 2, ',', '') .
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
