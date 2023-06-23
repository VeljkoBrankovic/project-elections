Dobrodosli, <?= $commision->name ?>
<br><br>
Stranica za clana komisije
<br><br>
1. <?= anchor("sendmail/send_voter_list/".$commision->id_section, "Dostavi biracke spiskove"); ?>
<br><br>
2. <?= anchor("sendmail/send_nomination_paper/".$commision->id_section, "Prosledi email-ove za kandidaturu"); ?>
<br><br>
3. <?= anchor("commission/get_candidacy_results/".$commision->id_section, "Pogledaj rezultate kandidovanja"); ?>
<br><br>
<?= anchor("commission/logout", "Log out"); ?>