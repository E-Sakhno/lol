<!-- <?php

// echo "Hiiiii";
include "api.php";
$nick = 'Медоed';
$region = "ru";

// $summoner_info = json_decode(file_get_contents('https://'.$region.'.api.riotgames.com/lol/summoner/v4/summoners/by-name/'.$nick.'?api_key='.$api), true);
// $summoner_id = $summoner_info["id"];
// echo $summoner_id;
// echo ' '; 

// $masters = json_decode(file_get_contents('https://'.$region.'.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/'.$summoner_id.'?api_key='.$api), true);
// var_dump(count($masters));
// echo ' '; 

// echo $masters[0]["championPoints"];
// echo ' '; 
// $masters_arr = array();
// for($i=0; $i<count($masters); $i++){
//     $masters_arr[$masters[$i]["championId"]] = $masters[$i]["championPoints"];
    
// }
// $total_masters = array_sum($masters_arr);
// echo ' '; 
// echo ' '; 
// echo ' '; 
// echo $total_masters;

?> -->

<a href="record_total.php"> Total</a><br>
<a href="record_min.php"> Min</a><br>
<a href="record_max.php"> Max</a><br>
<a href="record_true_mainers.php"> True mainer</a><br>
<a href="record_early.php?region=all&amount=15"> Didn't play</a><br>
<a href="record_rang.php"> Rang</a><br>
<a href="full_info.php"> My page</a><br>

<form action="index.php" method="post" name="form">
<select name="lang">
<option value="ru_RU" 
    <?php if (isset($_COOKIE['lang'])){if ($_COOKIE['lang'] == "ru_RU"){echo 'selected';}} ?> 
> Рус
    <option value="en_US" 
    <?php if (isset($_COOKIE['lang'])){if ($_COOKIE['lang'] == "en_US"){echo 'selected';}} ?> 
> Eng
</select>
<button class="btn btn-success btn">Кнопка</button>
</form>

<?php
if (empty($_COOKIE)){
    setcookie('lang', 'en_US');
}
if (!empty($_POST)){
    print_r ($_POST);
    $lang = $_POST['lang'];
    setcookie("lang", $lang);
    header("Refresh:0");
}
?>
