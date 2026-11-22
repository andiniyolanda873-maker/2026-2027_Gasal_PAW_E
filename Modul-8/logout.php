<?php
session_start();

unset($_SESSION['login']);
unset($_SESSION['id_user']);
unset($_SESSION['username']);
unset($_SESSION['nama']);
unset($_SESSION['level']);

header("Location: login.php");
exit;
