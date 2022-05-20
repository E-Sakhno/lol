 <?php
    echo $lang['Region'];
    ?>: <select onchange="On (this)" name="region">
<option value="br1" 
<?php if (isset($_GET['region'])){if ($_GET['region'] == "br1"){echo 'selected';}} ?> 
> BR
<option value="eun1" 
<?php if (isset($_GET['region'])){if ($_GET['region'] == "eun1"){echo 'selected';}} ?> 
> EuN
<option value="euw1" 
<?php if (isset($_GET['region'])){if ($_GET['region'] == "euw1"){echo 'selected';}} ?> 
> EuW
<option value="jp1" 
<?php if (isset($_GET['region'])){if ($_GET['region'] == "jp1"){echo 'selected';}} ?> 
> JP
<option value="kr" 
<?php if (isset($_GET['region'])){if ($_GET['region'] == "kr"){echo 'selected';}} ?> 
> KR
<option value="la1" 
<?php if (isset($_GET['region'])){if ($_GET['region'] == "la1"){echo 'selected';}} ?> 
> LA1
<option value="la2" 
<?php if (isset($_GET['region'])){if ($_GET['region'] == "la2"){echo 'selected';}} ?> 
> LA2
<option value="na1" 
<?php if (isset($_GET['region'])){if ($_GET['region'] == "na1"){echo 'selected';}} ?> 
> NA
<option value="oc1" 
<?php if (isset($_GET['region'])){if ($_GET['region'] == "oc1"){echo 'selected';}} ?> 
> OC
<option value="ru" 
    <?php if (isset($_GET['region'])){if ($_GET['region'] == "ru"){echo 'selected';}} ?> 
> Ru
<option value="tr1" 
<?php if (isset($_GET['region'])){if ($_GET['region'] == "tr1"){echo 'selected';}} ?> 
> TR

</select>