<?php
include "header.php";
echo '<h1>' . $lang['Spellblock'] . '</h1>';
?>
<title><?php echo $lang['Spellblock']; ?></title>
<div class="blok"> 
        <table id="sortable" border="1" >     
        
        <thead>
        <tr>
    <th><?php echo $lang['Hero'];?></th>       
    <th data-type="number"><?php echo $lang['Spellblock'];?></th>          
    <th data-type="number"><?php echo $lang['Spellblock'] . ' ' . $lang['perlvl'];?></th>          
    <th data-type="number"><?php echo $lang['Spellblock'] . ' ' . $lang['at18'];?></th>          
    </tr>
    </thead>
    <tbody>



<?php
include 'api.php';

$champsInfo = json_decode(file_get_contents('json/'.$_COOKIE['lang'].'_champs.json'), true);


foreach ($champsInfo['data'] as $key => $value){
echo "
<tr>
<td id=\"" . $value['key'] . "\"><div class=\"fullchamp\"><img id=\"" . $value['name']. "\" src=\"http://ddragon.leagueoflegends.com/cdn/". $version . "/img/champion/" . $value['image']['full'] . "\">" .
'<div class="fullchampname">' . $value['name'] .'</div></div></td>' .
'<td class="center">' . $value['stats']['spellblock'] . '</td>' . 
'<td class="center">' . $value['stats']['spellblockperlevel'] . '</td>' . 
'<td class="center">' . $value['stats']['spellblock'] +  17 * $value['stats']['spellblockperlevel'] . '</td>' . 
'</tr>';

}
echo '</tbody></table>';
// print_r ($champsInfo['data']["Aatrox"]["stats"]["MP"]);

include 'footer.php';
?>
