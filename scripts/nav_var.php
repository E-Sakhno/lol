<?php
$amount = ceil(str_replace(',', '.', $_GET['amount']));

    if (isset($_GET['p'])){
        $page = ceil(str_replace(',', '.', $_GET['p']));
    }
    else{
        $page = 1;
    }

    
    $ctr = 1 +  $amount * ($page-1);
    // echo $page;
    // print_r($info[$key]);
    if (!isset($nick)){
        $nick = '';
        $region_s = '';
    }
    $urlParams = '&region=' . $_GET['region'] . '&qu=' . $_GET['qu'] . '&amount=' . $amount . '&nick=' . $nick . "&region_s=" . $region_s. '&p=';
    $page_last = ceil(count($sum_by_num)/$amount);
?>