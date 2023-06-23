<?=$this->extend('default');?>

<?= $this->section('mainSection')?>

<h2>Login</h2>
<?php
echo $error ?? "";
echo "<br>";

echo form_open("Commission/login", ["method"=>"post"]);

echo form_label("Username:", "username");
echo form_input('username');
echo "<br>";

echo form_label("Password:", "password");
echo form_password('password');
echo "<br>";

echo form_submit("login", "Log in");
echo form_close();
?>
<?= $this->endSection();?>