<?php
include "header.php";
echo '<h1>' . $lang['MP'] . '</h1>';
?>
<title><?php echo $lang['MP']; ?></title>
<div class="blok"> 
        <table id="sortable" border="1" >     
        
        <thead>
        <tr>
    <th><?php echo $lang['Hero'];?></th>       
    <th data-type="number"><?php echo $lang['MP'];?></th>          
    <th data-type="number"><?php echo $lang['MP'] . ' ' . $lang['perlvl'];?></th>          
    <th data-type="number"><?php echo $lang['MP'] . ' ' . $lang['at18'];?></th>          
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
'<td class="center">' . $value['stats']['mp'] . '</td>' . 
'<td class="center">' . $value['stats']['mpperlevel'] . '</td>' . 
'<td class="center">' . $value['stats']['mp'] +  17 * $value['stats']['mpperlevel'] . '</td>' . 
'</tr>';

}
echo '</tbody></table>';
// print_r ($champsInfo['data']["Aatrox"]["stats"]["MP"]);

include 'footer.php';
?>
