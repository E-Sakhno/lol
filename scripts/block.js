let inp = document.querySelector('input.inp');
let sel = document.querySelector('select.inp');
let btn = document.querySelector('.btn');
btn.setAttribute('disabled', true);
 
inp.oninput = function(){
let val = inp.value;
  if (val.length < 1){
    btn.setAttribute('disabled', true);
  }else{
    btn.removeAttribute('disabled');
  }

}
