<?=$this->extend('default');?>

<?= $this->section('mainSection')?>

Dobrodosli, <?= $name ?>
<br><br>
Stranica za clana komore
<br><br>
<?= anchor("member/logout", "Log out"); ?>

<?= $this->endSection();?>