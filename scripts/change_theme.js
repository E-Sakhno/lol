const checkbox = document.querySelector(".theme-switcher");

checkbox.addEventListener("change", function() {
  const themeContainer = document.querySelector(".theme-container");
  if (themeContainer && this.checked) {
    themeContainer.classList.add("light");
  } else {
    themeContainer.classList.remove("light");
  }
});

theme.onclick = function(){

if (theme.checked) { 
    set_cookie('theme', 'light');
    var link = document.getElementById('themechange');
    link.setAttribute('href', 'style/total.css');
}
    else {set_cookie('theme', 'dark');
    var link = document.getElementById('themechange');
    link.setAttribute('href', 'style/total-dark.css');
    }

} 