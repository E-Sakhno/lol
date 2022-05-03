Region: <select name="region"">
<option value="all" 
    <?php if (isset($_GET['region']))
    {if ($_GET['region'] == "all")
    {echo 'selected';}} ?> 
> All
<option value="ru" 
    <?php if (isset($_GET['region'])){if ($_GET['region'] == "ru"){echo 'selected';}} ?> 
> Ru
    <option value="euw1" 
    <?php if (isset($_GET['region'])){if ($_GET['region'] == "euw1"){echo 'selected';}} ?> 
> EuW

</select>