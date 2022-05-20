<?php echo $lang['Queue'];?>: <select name="qu">
    <option value="solo"> <?php echo $lang['Solo'];?>
    <option value="flex" 
    <?php if (isset($_GET['qu'])){if ($_GET['qu'] == 'flex'){echo 'selected';}} ?> > <?php echo $lang['Flex'];?>
    <!-- <option value="tft"
    <?php if (isset($_GET['qu'])){if ($_GET['qu'] == 'tft'){echo 'selected';}} ?> > Тфт -->
</select>