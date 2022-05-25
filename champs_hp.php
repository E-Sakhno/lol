<?php
include "header.php";
echo '<h1>' . $lang['HP'] . '</h1>';
?>
<title><?php echo $lang['HP'];?></title>
<div class="blok"> 
        <table id="sortable" border="1" >     
        
        <thead>
        <tr>
    <th><?php echo $lang['Hero'];?></th>       
    <th data-type="number"><?php echo $lang['HP'];?></th>          
    <th data-type="number"><?php echo $lang['HP'] . ' ' . $lang['perlvl'];?></th>          
    <th data-type="number"><?php echo $lang['HP'] . ' ' . $lang['at18'];?></th>          
    </tr>
    </thead>
    <tbody>



<?php
include 'api.php';

$champsInfo = json_decode(file_get_contents('json/'.$_COOKIE['lang'].'_champs.json'), true);


foreach ($champsInfo['data'] as $key => $value){
    $hp18 = $value['stats']['hp'] +  17 * $value['stats']['hpperlevel'];
echo "
<tr>
<td id=\"" . $value['key'] . "\"><div class=\"fullchamp\"><img id=\"" . $value['name']. "\" src=\"http://ddragon.leagueoflegends.com/cdn/". $version . "/img/champion/" . $value['image']['full'] . "\">" .
'<div class="fullchampname">' . $value['name'] .'</div></div></td>' .
'<td class="center">' . $value['stats']['hp'] . '</td>' . 
'<td class="center">' . $value['stats']['hpperlevel'] . '</td>' . 
'<td class="center">' . $hp18 . '</td>' . 
'</tr>';

}
echo '</tbody></table>';
// print_r ($champsInfo['data']["Aatrox"]["stats"]["hp"]);

include 'footer.php';
?>
