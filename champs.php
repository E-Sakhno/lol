<link rel="stylesheet" href="style/total.css">
<p> Всё о чемпионах </p>
<div class="blok"> 
        <table id="sortable" border="1" >     
        
        <thead>
        <tr>
    <th> Ava </th>         
    <th> Имя </th>         
    <th data-type="number"> Сложность </th>          
    <th data-type="number"> HP  </th>
    <th data-type="number"> hpperlevel  </th>
    <th data-type="number"> HP at 18 </th>
    <th data-type="number"> MP </th>
    <th data-type="number"> Mpperlevel  </th>
    <th data-type="number"> MP  at 18</th>
    <th data-type="number"> movespeed  </th>
    <th data-type="number"> attackdamage  </th>
    <th data-type="number"> attackdamageperlevel  </th>
    <th data-type="number"> attackdamage at 18  </th>
    <th> Последний раз сыграно  </th>
    <th> Сундук  </th>
    <th > Жетонов в инвентаре </th>
    </tr>
    </thead>
    <tbody>



<?php
include 'api.php';

$champsInfo = json_decode(file_get_contents('json/'.$_COOKIE['lang'].'_champs.json'), true);

// $avatar = [];
// foreach ($champsInfo['data'] as $key => $value){
//     $avatar[$value['key']] = $value['image']['full'];
// }

// print_r ($avatar);
// file_put_contents('json/ava_champs.json', json_encode($avatar, JSON_UNESCAPED_UNICODE));



foreach ($champsInfo['data'] as $key => $value){
echo "
<tr><td><img src=\"http://ddragon.leagueoflegends.com/cdn/". $version . "/img/champion/" . $value['image']['full'] . "\">" .  "</td><td>" .
$value['name'] .
'</td>
<td>' . 
$value['info']['difficulty'] .
'</td>
<td>'  . 
$value['stats']['hp'] . 
'</td>
<td>' . 
$value['stats']['hpperlevel'] . 
'</td>
<td>' .
$value['stats']['hp'] +  18 * $value['stats']['hpperlevel'] . 

'</td><td>' .  

$value['stats']['mp'] . 
'</td>
<td>' . 
$value['stats']['mpperlevel'] . 
'</td><td>' .  
$value['stats']['mp'] + 18*$value['stats']['mpperlevel'] . 
'</td><td>' .  

$value['stats']['movespeed'] . 
'</td><td>' .  

$value['stats']['attackdamage'] . 
'</td><td>' .  

$value['stats']['attackdamageperlevel'] . 
'</td><td>' .  
$value['stats']['attackdamage'] +  18 * $value['stats']['attackdamageperlevel'] . 


'</td><td>'  
;
}
print_r ($champsInfo['data']["Aatrox"]["stats"]["hp"]);

include 'footer.php';
?>
