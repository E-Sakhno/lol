<link rel="stylesheet" href="style/switcher.css">
<link rel="stylesheet" href="style/total.css">
<head>
<!-- <link rel="stylesheet" title="theme" href="#"> -->
<script src="scripts/show_more.js"></script>
<script src="scripts/cookies.js"></script>
<script src="scripts/select_click.js"></script>
<script>
if (!get_cookie('tz')){
    
var timezone = (Intl.DateTimeFormat().resolvedOptions().timeZone);
set_cookie('tz', timezone);

}
</script>

<script>
    if (!get_cookie('lang')){    
        set_cookie('lang', "en_US");
    }
    </script>


<script>
    let changeThemeButtons = document.querySelectorAll('.changeTheme'); // Помещаем кнопки смены темы в переменную

changeThemeButtons.forEach(button => {
    button.addEventListener('click', function () { // К каждой добавляем обработчик событий на клик
        let theme = this.dataset.theme; // Помещаем в переменную название темы из атрибута data-theme
        applyTheme(theme); // Вызываем функцию, которая меняет тему и передаем в нее её название
    });
});

function applyTheme(themeName) {
    document.querySelector('[title="theme"]').setAttribute('href', `css/theme-${themeName}.css`); // Помещаем путь к файлу темы в пустой link в head
    changeThemeButtons.forEach(button => {
        button.style.display = 'block'; // Показываем все кнопки смены темы
    });
    document.querySelector(`[data-theme="${themeName}"]`).style.display = 'none'; // Но скрываем кнопку для активной темы
}

let changeThemeButtons = document.querySelectorAll('.changeTheme');

changeThemeButtons.forEach(button => {
    button.addEventListener('click', function () {
        let theme = this.dataset.theme;
        applyTheme(theme);
    });
});

function applyTheme(themeName) {
    document.querySelector('[title="theme"]').setAttribute('href', `css/theme-${themeName}.css`);
    changeThemeButtons.forEach(button => {
        button.style.display = 'block';
    });
    document.querySelector(`[data-theme="${themeName}"]`).style.display = 'none';
    localStorage.setItem('theme', themeName);
}

let activeTheme = localStorage.getItem('theme'); // Проверяем есть ли в LocalStorage записано значение для 'theme' и присваиваем его переменной.

if(activeTheme === null || activeTheme === 'light') { // Если значение не записано, или оно равно 'light' - применяем светлую тему
    applyTheme('light');
} else if (activeTheme === 'dark') { // Если значение равно 'dark' - применяем темную
    applyTheme('dark');
}
    
    </script>

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
                        <li><a href="millions.php?qu=solo&region=all&amount=10"><?php echo $lang['Millions'];?></a></li>
                    </ul>
                </li>
                <li><a><?php echo $lang['Records_rank'];?></a>
                    <ul>
                        <li><a href="record_rank_winrate.php?qu=solo&region=all&amount=10"><?php echo $lang['Winrate'];?></a></li>
                        <li><a href="antirecord_rank_winrate.php?qu=solo&region=all&amount=10"><?php echo $lang['AntiWinrate'];?></a></li>
                    </ul>
                </li>
                <li><a href="current_game.php"><?php echo $lang['LiveGame'];?></a>
                </li>
                <li><a href="full_info.php"><?php echo $lang['About_sum'];?></a>
                </li>
                <li></li>
                <li><a href=".php"><?php echo $lang['About_champs'];?></a>
                    <ul>
                        <li><a href=".php">HP</a></li>
                        <li><a href=".php">Resist</a></li>
                        <li><a href=".php">ПРОЧЕЕ</a></li>
                    </ul>
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
                <li>
                <label class="switch">
        <input type="checkbox" class="theme-switcher">
        <span class="slider round"></span>
      </label>
                
</li>
            </ul>
        </nav>
        

    </div>
    <script>
        function AtChange (select) {
    var selectedOption = select.options[select.selectedIndex].value;
    console.log(selectedOption);
    set_cookie('lang', selectedOption);
}
    </script>

</head>
<div class="body">

