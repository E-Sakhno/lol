function OnSelectionChange (select) {
            var selectedOption = select.options[select.selectedIndex];
            let val = inp.value;
            if (val.length > 1){
            //   alert val;
            btn.removeAttribute('disabled');
  }
            // alert ("The selected option is " + selectedOption.value);
        }