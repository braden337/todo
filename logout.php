<?php
session_start();

unset($_SESSION['user']);

$_SESSION['flash_status'] = 'success';
$_SESSION['flash_message'] = "You are now logged out.";

header("Location: /login.php");