<?php
include "header.php";
?>
<!-- <img style="height:20em;" src = "https://sun9-26.userapi.com/impf/c621513/v621513214/6a1b5/4PpD0eFT82s.jpg?size=1280x720&quality=96&sign=c4634c0fa75be98cfad95972f5f4cd07&c_uniq_tag=eGJPpinaYRXXG2CUxNFf42KqYoWiKJRFQV5VuSE_UG0&type=album"> -->
<br>
<br>
Know about yourself at 120%
<br>
KnowYourChampion
KYC
<br>
<br>
Product 'KnowYourChampion' is a very easy to calculate total points of each summoner. Also there is different top of summoners such as
tops by total mastery score, mastery levels, levels, last games, min and max points on champs, winrate in ranked games.
Also there is information about champions stats (HP, MP, attack damage etc).
Also every player can see tips for playing with and again champs in LiveGame.
To minimizade the amount of requests, my site checkes the exist of IDs in my files. Information in LiveGame send the request for current game of the summoner and for other, if there is no information in site's files.
If you will approve my project, I will upgrade hosting for more users and buy domain-name with SSL. Also I will add favicon and advertising and nformation about helping to site (translation, donation). 
The APIs site is using are: CHAMPION-MASTERY-V4, LEAGUE-V4, and SUMMONER-V4 and Data Dragon.
<br>
<br>



<a href="record_total.php?region=all&qu=solo&amount=10"> Total</a><br>
<a href="record_total_mastery.php?region=all&qu=solo&amount=10"> Total mastery</a><br>
<a href="record_true_mainers.php?region=all&qu=solo&amount=10"> True mainer</a><br>
<a href="record_lvl.php?region=all&qu=solo&amount=10">Lvl</a><br>
<a href="record_early.php?region=all&qu=solo&amount=10"> Didn't play</a><br>
<a href="record_rang.php?rang=7&region=all&qu=solo&amount=10"> <b>Rang</b></a><br>

<a href="record_min.php?region=all&qu=solo&amount=10"> Min</a><br>
<a href="record_max.php?region=all&qu=solo&amount=10"> Max</a><br>
<a href="millions.php?qu=solo&region=all&amount=10"> <b>Millions</b></a><br>

<a href="record_rank_winrate.php?qu=solo&region=all&amount=10"> Winrate</a><br>
<a href="antirecord_rank_winrate.php?qu=solo&region=all&amount=10"> <b>ANTIWinrate</b></a><br>

<a href="current_game.php"> Current game</a><br>
<a href="full_info.php"> My page</a><br>
<br>
<br>
<!-- <a href="champs.php"> Champs</a><br> -->
<br>
<br>

<script src="scripts/cookies.js"></script>

<?php
include "footer.php";
?>