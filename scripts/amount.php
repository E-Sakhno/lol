<select name="amount">
<option value="1" 
    <?php if (isset($_GET['amount'])){if ($_GET['amount'] == "1"){echo 'selected';}} ?>
> 1
<option value="5" 
    <?php if (isset($_GET['amount'])){if ($_GET['amount'] == "5"){echo 'selected';}} ?>
> 5
<option value="10" 
    <?php if (isset($_GET['amount'])){if ($_GET['amount'] == "10"){echo 'selected';}} ?>
> 10

</select>