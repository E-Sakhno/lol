if (array_key_exists($key, $info_rang)){
    $img = $info_rang[$key][$l['add']]. '<img src="img/Emblem_' . $info_rang[$key][$l['tier']] . ".png\">";
    if ($info_rang[$key][$l['tier']] == "CHALLENGER" and $info_rang[$key][$l['rank']] == 'I'){
        $elo = $info_rang[$key][$l['tier']] . ' ' . $info_rang[$key][$l['lp']];
    }
    else{
        
        $elo = $info_rang[$key][$l['tier']] . ' ' . $info_rang[$key][$l['rank']];
    }
}
else{
    $img = '';
    $elo = '&zwnj;&zwnj; - ';
    
}