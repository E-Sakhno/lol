<?php
    echo $lang['Region'];
    ?>: <select onchange="OnChange (this)" name="region_s">
<option value="br1" 
<?php if (isset($_GET['region_s'])){if ($_GET['region_s'] == "br1"){echo 'selected';}} ?> 
> BR
<option value="eun1" 
<?php if (isset($_GET['region_s'])){if ($_GET['region_s'] == "eun1"){echo 'selected';}} ?> 
> EuN
<option value="euw1" 
<?php if (isset($_GET['region_s'])){if ($_GET['region_s'] == "euw1"){echo 'selected';}} ?> 
> EuW
<option value="jp1" 
<?php if (isset($_GET['region_s'])){if ($_GET['region_s'] == "jp1"){echo 'selected';}} ?> 
> JP
<option value="kr" 
<?php if (isset($_GET['region_s'])){if ($_GET['region_s'] == "kr"){echo 'selected';}} ?> 
> KR
<option value="la1" 
<?php if (isset($_GET['region_s'])){if ($_GET['region_s'] == "la1"){echo 'selected';}} ?> 
> LA1
<option value="la2" 
<?php if (isset($_GET['region_s'])){if ($_GET['region_s'] == "la2"){echo 'selected';}} ?> 
> LA2
<option value="na1" 
<?php if (isset($_GET['region_s'])){if ($_GET['region_s'] == "na1"){echo 'selected';}} ?> 
> NA
<option value="oc1" 
<?php if (isset($_GET['region_s'])){if ($_GET['region_s'] == "oc1"){echo 'selected';}} ?> 
> OC
<option value="ru" 
    <?php if (isset($_GET['region_s'])){if ($_GET['region_s'] == "ru"){echo 'selected';}} ?> 
> Ru
<option value="tr1" 
<?php if (isset($_GET['region_s'])){if ($_GET['region_s'] == "tr1"){echo 'selected';}} ?> 
> TR

</select>