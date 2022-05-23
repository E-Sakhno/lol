function set_fav (text){
    var array = [];    
    if (localStorage.getItem("fav")){
        var array = JSON.parse(localStorage.getItem("fav"));
    }
    // if (!array.includes(text.innerHTML)){
    
    var url_string = window.location.href 
    var url = new URL(url_string); 
    var nick = url.searchParams.get("nick"); 
    var region = url.searchParams.get("region"); 
    console.log(nick);
    console.log(region);
    var obj = {};
    obj[nick] = region;
    array.push(obj);
    localStorage.setItem("fav", JSON.stringify(array));
    console.log(array);
// }
}
function rem_fav (text){
    
    var array = JSON.parse(localStorage.getItem("fav"));
    // array.
    

}