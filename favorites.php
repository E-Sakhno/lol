<script src="scripts/fav.js"></script>


<div onclick="set_fav (this)">Вася</div>


<div id="">Список всего</div>
<div id="list">Список всего</div>

<script>
    var array = [];    
if (localStorage.getItem("fav")){
    var array = JSON.parse(localStorage.getItem("fav"));
}

var str_fav = '';
console.log(array.length);
for (let i=0; i<array.length; i++){
    str_fav += array[i] + '<br>';
}
// console.log(str_fav);
div = document.getElementById('list');
div.innerHTML = str_fav;

</script>



