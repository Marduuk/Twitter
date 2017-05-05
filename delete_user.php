<?php
require('connect.php');
require('src/User_class.php');
session_start();
if ($_SESSION['loggedin'] != null && is_numeric($_SESSION['loggedin'])) {
    
} else {
    header('Location: loginpage.php');
}
echo "hey";

$user=User::loadUserById($connection,$_SESSION['loggedin']);


  if($user ->delete($connection)){//czemu nie dziala :(
  echo "uzytkownik usuniety";
  }
  else{
  echo "nie usunieto";
  }