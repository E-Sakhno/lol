<p>
    Топ мейнеров

    <form action="record_true_mainers.php" method="get" name="form">
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
include "header.php";
if (isset($_GET['region'])) {
    include 'scripts/info.php';
    // print_r($info);
    $summoners = [];
    foreach ($info as $key => $row) {
        $summoners[$key] = $row[$k['7']] + $row[$k['6']] + $row[$k['5']] + $row[$k['4']] + $row[$k['3']] + $row[$k['2']] + $row[$k['1']];    }
    array_multisort($summoners, SORT_ASC, $info);
    // echo "<BR>";
    // echo "<BR>";
    // print_r ($summoners);

    // $champs_name = json_decode(
    //     file_get_contents('json/'. $_COOKIE['lang'] . '_champs.json'),
    //     true,
    //     JSON_UNESCAPED_UNICODE
    // );
    // print_r($champs_name);

    echo '<table border="1" >     <tr>  <td> № </td>       <td> Ник </td>          <td> Регион </td>         <td> Кол-во чампов </td></tr>';

    $ctr = 1;
    // print_r($info[$key]);
    foreach ($summoners as $key => $value) {
        echo '<tr><td>'. $ctr . "</td><td><a href='test.php?nick=" . $info[$key][$k['nick']] . "&region="  . $info[$key][$k['region']] . "'>" .
            $info[$key][$k['nick']] .
            '</a></td><td>' .
            $info[$key][$k['region']] .
            '</td><td>' .
            number_format($value, 0, ',', ' ') .
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
