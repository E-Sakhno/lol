<p>
    Топ по количеству
    <?php
if (isset($_GET['rang'])){
    echo $_GET['rang'];
}

?>
     рангов

    <form action="record_rang.php" method="get" name="form">
    Rang: <select name="rang">
    <option value="7"> 7
    <option value="6" 
    <?php if (isset($_GET['rang'])){if ($_GET['rang'] == 6){echo 'selected';}} ?> > 6
    <option value="5"
    <?php if (isset($_GET['rang'])){if ($_GET['rang'] == 5){echo 'selected';}} ?> > 5
    <option value="4"
    <?php if (isset($_GET['rang'])){if ($_GET['rang'] == 4){echo 'selected';}} ?> > 4
    <option value="3"
    <?php if (isset($_GET['rang'])){if ($_GET['rang'] == 3){echo 'selected';}} ?> > 3
    <option value="2"
    <?php if (isset($_GET['rang'])){if ($_GET['rang'] == 2){echo 'selected';}} ?> > 2
    <option value="1"
    <?php if (isset($_GET['rang'])){if ($_GET['rang'] == 1){echo 'selected';}} ?> > 1
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
    // print_r($info);
    $summoners = [];
    foreach ($info as $key => $row) {
        $summoners[$key] = $row[$k[$_GET['rang']]];
    }
    array_multisort($summoners, SORT_DESC, $info);

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
    <td> Количество  </td></tr>';

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
