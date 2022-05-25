<?php
include "header.php";
echo '<h1>' . $lang['Regen'] . ' ' . $lang['MPs'] . '</h1>';
?>
<title><?php echo $lang['Regen'];?></title>
<div class="blok"> 
        <table id="sortable" border="1" >     
        
        <thead>
        <tr>
    <th><?php echo $lang['Hero'];?></th>       
    <th data-type="number"><?php echo $lang['Default'];?></th>          
    <th data-type="number"><?php echo $lang['perlvl'];?></th>          
    <th data-type="number"><?php echo $lang['at18'];?></th>          
    </tr>
    </thead>
    <tbody>



<?php
include 'api.php';

$champsInfo = json_decode(file_get_contents('json/'.$_COOKIE['lang'].'_champs.json'), true);


foreach ($champsInfo['data'] as $key => $value){
    $mp = $value['stats']['mpregen']/5;
    $mppl = $value['stats']['mpregenperlevel']/5;
    $mp18 = $mp +  17 * $mppl;
echo "
<tr>
<td id=\"" . $value['key'] . "\"><div class=\"fullchamp\"><img id=\"" . $value['name']. "\" src=\"http://ddragon.leagueoflegends.com/cdn/". $version . "/img/champion/" . $value['image']['full'] . "\">" .
'<div class="fullchampname">' . $value['name'] .'</div></div></td>' .
'<td class="center">' . $mp . '</td>' . 
'<td class="center">' . $mppl . '</td>' . 
'<td class="center">' . $mp18 . '</td>' . 
'</tr>';

}
echo '</tbody></table>';
// print_r ($champsInfo['data']["Aatrox"]["stats"]["hp"]);

include 'footer.php';
?>
