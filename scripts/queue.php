Очередь: <select name="qu">
    <option value="solo"> Соло
    <option value="flex" 
    <?php if (isset($_GET['qu'])){if ($_GET['qu'] == 'flex'){echo 'selected';}} ?> > Флекс
    <!-- <option value="tft"
    <?php if (isset($_GET['qu'])){if ($_GET['qu'] == 'tft'){echo 'selected';}} ?> > Тфт -->
</select>