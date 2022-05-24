<?php
include "header.php";
echo '<h1>'.$lang['About_champs'] . '</h1>';
?>
<title><?php echo $lang['About_champs']; ?></title>
<div class="blok"> 
        <table id="sortable" border="1" >     
        
        <thead>
        <tr>
    <th><?php echo $lang['Hero'];?></th>       
    <th data-type="number"><?php echo $lang['Attack'];?></th>          
    <th data-type="number"><?php echo $lang['Defense'];?></th>          
    <th data-type="number"><?php echo $lang['Magic'];?></th>          
    <th data-type="number"><?php echo $lang['Difficulty'];?></th>          
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
'<td class="center">' . $value['info']['attack'] . '</td>' . 
'<td class="center">' . $value['info']['defense'] . '</td>' . 
'<td class="center">' . $value['info']['magic'] . '</td>' . 
'<td class="center">' . $value['info']['difficulty'] . '</td>' . 
'</tr>';

}
echo '</tbody></table>';
// print_r ($champsInfo['data']["Aatrox"]["stats"]["hp"]);

include 'footer.php';
?>
