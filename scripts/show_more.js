function show(element_id) {
  var obj = document.getElementById(element_id)
  if (obj.style.display != 'block') {
    obj.style.display = 'block'
  } else {
    obj.style.display = 'none'
  }
  var obj2 = document.getElementById('show_link');
  obj2.style.display = 'none';
  
}
