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
    <th> Последний раз сыграно  </th>
    <th> Сундук  </th>
    <th > Жетонов в инвентаре </th>
    </tr>
    </thead>
    <tbody>



<?php

$champsInfo = json_decode(file_get_contents('json/'.$_COOKIE['lang'].'_champs.json'), true);

// $avatar = [];
// foreach ($champsInfo['data'] as $key => $value){
//     $avatar[$value['key']] = $value['image']['full'];
// }

// print_r ($avatar);
// file_put_contents('json/ava_champs.json', json_encode($avatar, JSON_UNESCAPED_UNICODE));



foreach ($champsInfo['data'] as $key => $value){
echo "
<tr><td><img src=\"http://ddragon.leagueoflegends.com/cdn/12.8.1/img/champion/" . $value['image']['full'] . "\">" .  "</td><td>" .
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
<td>'

;
}
print_r ($champsInfo['data']["Aatrox"]["stats"]["hp"]);

include 'footer.php';
?>
