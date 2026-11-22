<?php
include "cek_login.php";

if ($_SESSION['level'] != 1) {
    header("Location: index.php");
    exit;
}
