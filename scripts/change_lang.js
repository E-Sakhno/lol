function AtChange (select) {
    var selectedOption = select.options[select.selectedIndex].value;
    console.log(selectedOption);
    set_cookie('lang', selectedOption);
    location.reload();
}