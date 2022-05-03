function show(element_id) {
  var obj = document.getElementById(element_id)
  if (obj.style.display != 'block') {
    obj.style.display = 'block'
  } else {
    obj.style.display = 'none'
  }
}
