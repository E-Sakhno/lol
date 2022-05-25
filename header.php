<link rel="stylesheet" href="style/switcher.css">
<link id="themechange" rel="stylesheet" href="style/total<?php if ($_COOKIE['theme'] == 'dark'){echo '-dark';}?>.css">
<head>
<!-- <link rel="stylesheet" title="theme" href="#"> -->
<script src="scripts/show_more.js"></script>
<script src="scripts/cookies.js"></script>
<script src="scripts/select_click.js"></script>

<script src="scripts/timezone.js"></script>
<script src="scripts/lang.js"></script>
<script src="scripts/default_theme.js"></script>

<?php
if ($_COOKIE['tz']){
    
    $tz = $_COOKIE['tz'];
    date_default_timezone_set($tz);
   }

$k = [
    'nick' => 0,
    'region' => 1,
    'icon' => 2,
    'lvl' => 3,
    'total' => 4,
    'min_key' => 5,
    'min_point' => 6,
    'max_key' => 7,
    'max_point' => 8,
    'early_key' => 9,
    'early_point' => 10,
    '7' => 11,
    '6' => 12,
    '5' => 13,
    '4' => 14,
    '3' => 15,
    '2' => 16,
    '1' => 17,
];

$l = [
    'nick' => 0,
    'region' => 1,
    'lp' => 2,
    'wins' => 3,
    'losses' => 4,
    'tier' => 5,
    'rank' => 6,
    'add' => 7
];

// $t = [
//     'nick' => 0,
//     'region' => 1,
//     'lp' => 2,
//     'wins' => 3,
//     'losses' => 4
// ];

$add = [
    'IRON' => '&zwnj;',
    'BRONZE' => '&zwnj;',
    'SILVER' => '&shy;&shy;',
    'GOLD' => '&shy;&shy;',
    'PLATINUM' => '&shy;',
    'DIAMOND' => '&shy;',
    'MASTER' => '',
    'GRANDMASTER' => '',
    'CHALLENGER' => '',
    '-' => '',
];
$version = '12.9.1';

$lang = json_decode(file_get_contents('lang/' . $_COOKIE['lang'] . '.json'), true);
    
?>


<div class="new-header">
        <nav>
            <ul>
                <li><a href="index.php"> <img src="home.png" height="25px" style="margin-left: 5px; margin-right: 5px;"> </a>

                <!-- <li class="li_hover" style="margin-right: 35px;"> <a><?php echo $lang['Records_total'];?></a></li> -->
                <li><a><?php echo $lang['Records_total'];?></a>
                    <ul>
                        <li><a href="record_total.php?region=all&qu=solo&amount=10"><?php echo $lang['Point'];?></a></li>
                        <li><a href="record_rang.php?rang=7&region=all&qu=solo&amount=10"><?php echo $lang['Mastery'];?></a></li>
                        <li><a href="record_total_mastery.php?region=all&qu=solo&amount=10"><?php echo $lang['Points'];?></a></li>
                        <li><a href="record_lvl.php?region=all&qu=solo&amount=10"><?php echo $lang['Lvl'];?></a></li>
                        <li><a href="record_true_mainers.php?region=all&qu=solo&amount=10"><?php echo $lang['TrueMainers'];?></a></li>
                        <li><a href="record_early.php?region=all&qu=solo&amount=10"><?php echo $lang['Didnt_play'];?></a></li>
                    </ul>
                </li>
                <li><a><?php echo $lang['Records_champs'];?></a>
                    <ul>
                        <li><a href="record_min.php?region=all&qu=solo&amount=10"><?php echo $lang['Min'];?></a></li>
                        <li><a href="record_max.php?region=all&qu=solo&amount=10"><?php echo $lang['Max'];?></a></li>
                        <li><a href="record_percent.php?region=all&qu=solo&amount=10">%</a></li>
                        <li><a href="millions.php?qu=solo&region=all&amount=10"><?php echo $lang['Millions'];?></a></li>
                    </ul>
                </li>
                <li><a><?php echo $lang['Records_rank'];?></a>
                    <ul>
                        <li><a href="record_rank_winrate.php?qu=solo&region=all&amount=10"><?php echo $lang['Winrate'];?></a></li>
                        <li><a href="antirecord_rank_winrate.php?qu=solo&region=all&amount=10"><?php echo $lang['AntiWinrate'];?></a></li>
                    </ul>
                </li>
                
                
                <li></li>
                <li><a href="champs_about.php"><?php echo $lang['About_champs'];?></a>
                    <ul>
                        <li><a href="champs_hp.php"><?php echo $lang['HP'];?></a></li>
                        <li><a href="champs_mp.php"><?php echo $lang['MP'];?></a></li>
                        <li><a href="champs_regen.php"><?php echo $lang['Regen'] . ' ' . $lang['HPs'];?></a></li>
                        <li><a href="champs_regenMP.php"><?php echo $lang['Regen'] . ' ' . $lang['MPs'];?></a></li>
                        <li><a href="champs_attack.php"><?php echo $lang['Attack'];?></a></li>
                        <li><a href="champs_attackrange.php"><?php echo $lang['Attackrange'];?></a></li>
                        <li><a href="champs_armor.php"><?php echo $lang['Armor'];?></a></li>
                        <li><a href="champs_spellblock.php"><?php echo $lang['Spellblock'];?></a></li>
                        <li><a href="champs_movespeed.php"><?php echo $lang['Movespeed'];?></a></li>
                    </ul>
                </li>
                <li><a href="full_info.php"><?php echo $lang['About_sum'];?></a>
                </li>
                <li><a href="current_game.php"><?php echo $lang['LiveGame'];?></a>
                </li>
                <li style="float: right; margin-right: 0.5em;">
                    <div style="margin-top: .5em; ">
                    <form action="" method="post" name="form">
                    <select name="lang" onchange="AtChange (this)">
                    <option value="ru_RU" 
                        <?php if (isset($_COOKIE['lang'])){if ($_COOKIE['lang'] == "ru_RU"){echo 'selected';}} ?> 
                    > Рус
                        <option value="en_US" 
                        <?php if (isset($_COOKIE['lang'])){if ($_COOKIE['lang'] == "en_US"){echo 'selected';}} ?> 
                    > Eng
                    </select>
                    <!-- <button class="btn btn-success btn">Тык</button> -->
                    </form>
                    </div>

                </li>
                <li style="float: right; margin-right: 0.5em;">
                <div class="grid theme-container">
  <div class="content">
    <div class="demo">
      <label class="switch">
        <input type="checkbox" id="theme" class="theme-switcher" 
        <?php if ($_COOKIE['theme'] == 'light'){echo ' checked';}?>
        >
        <span class="slider round"></span>
      </label>
    </div>
  </div>
</div>
                
</li>
</ul>
        </nav>
        

    </div>
<script src="scripts/change_lang.js"></script>
<script src="scripts/change_theme.js"></script>


</head>
<body>

<div class="body">

