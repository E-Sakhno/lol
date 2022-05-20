function OnSelectionChange (select) {
    var selectedOption = select.options[select.selectedIndex];
    let val = inp.value;
    if (val.length > 1){
         btn.removeAttribute('disabled');
    }
}

function OnChange (select) {
    var selectedOption = select.options[select.selectedIndex];
    let val = inp.value;
    if (val.length > 1){
         btn.removeAttribute('disabled');
    }
}

function On (select) {
    var selectedOption = select.options[select.selectedIndex];
    let val = inp.value;
    if (val.length > 1){
         btn.removeAttribute('disabled');
    }
}