<?php echo $lang['Post']; ?>
<select name="amount">
<option value="10" 
    <?php if (isset($_GET['amount'])){if ($_GET['amount'] == "10"){echo 'selected';}} ?>
> 10
<option value="50" 
    <?php if (isset($_GET['amount'])){if ($_GET['amount'] == "50"){echo 'selected';}} ?>
> 50
<option value="100" 
    <?php if (isset($_GET['amount'])){if ($_GET['amount'] == "100"){echo 'selected';}} ?>
> 100

</select>