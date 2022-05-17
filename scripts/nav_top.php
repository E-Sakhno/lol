<?php

if ($page_last <=6){
    echo '<div class="pages">';
    if ($page != 1){
        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page-1 . '"> < </a></div>';

    }

        for ($n=1; $n<=$page_last; $n++){
            $url = $urlParams . $n;
        if ($n == $page){
            $cur = ' current';
        }
        else{
            $cur = '';
        }
        echo '<div class="pagenum' .$cur. '"><a href="record_total.php?'. $url . '">' . $n . " </a></div>";

    }
    if ($page != $page_last){
        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page+1 . '"> > </a></div>';

    }
    
}
    else{
    if ($amount > 10){
    echo '<div class="pages">';
    if ($page > 1){

        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page-1 . '"> < </a></div>';
    }

    if ($page >= 5 and $page_last >= 7 and $page < $page_last - 3){
        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . 1 . '"> 1 </a></div>';
        echo '<div class="pagenum">...</div>';
        for ($n=$page-2; $n<=$page+2; $n++){
            $url = $urlParams . $n;
        if ($n == $page){
            $cur = ' current';
        }
        else{
            $cur = '';
        }
        echo '<div class="pagenum' .$cur. '"><a href="record_total.php?'. $url . '">' . $n . " </a></div>";

        
    }
    echo '<div class="pagenum">...</div>';
    echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page_last . '">' . $page_last . " </a></div>";

    }
    else{

        if ($page < 5){


    for ($n=1; $n <= 5; $n++){
        $url = $urlParams . $n;
        if ($n == $page){
            $cur = ' current';
        }
        else{
            $cur = '';
        }
        echo '<div class="pagenum' .$cur. '"><a href="record_total.php?'. $url . '">' . $n . " </a></div>";
    }
    echo '<div class="pagenum">...</div>';
    echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page_last . '">' . $page_last . " </a></div>";

    }
    else{
        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . 1 . '"> 1 </a></div>';
        echo '<div class="pagenum">...</div>';
        for ($n=$page_last-4; $n<=$page_last; $n++){
            $url = $urlParams . $n;
        if ($n == $page){
            $cur = ' current';
        }
        else{
            $cur = '';
        }
        echo '<div class="pagenum' .$cur. '"><a href="record_total.php?'. $url . '">' . $n . " </a></div>";
    
    }
    }
    }






    if ($page < ceil(count($sum_by_num)/$amount)){

        echo '<div class="pagenum"><a href="record_total.php?'. $urlParams . $page+1 . '"> > </a></div>';
    }
    echo "</div>";
}

    // echo ceil(count($sum_by_num)/$_GET['amount']);

}
?>