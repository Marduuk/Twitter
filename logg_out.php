<?php
session_start();
header('Location: login_page.php');
$_SESSION['loggedin'] = 0;
