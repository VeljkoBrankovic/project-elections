<?=$this->extend('default');?>

<?= $this->section('mainSection')?>

<h1>Sajt komore</h1>
<?php
echo $error ?? "";
echo "<br>";

echo anchor("Member/login","Uloguj se kao clan komore");
echo "<br>";
echo anchor("Commission/login", "Uloguj se kao clan komisije");

?>
<?= $this->endSection();?>