<?php
session_start();
if ($_SESSION['loggedin'] != null && is_numeric($_SESSION['loggedin'])) {
    
} else {
    header('Location: loginpage.php');
}
require('connect.php');
require('class.php');

$sql="SELECT * FROM users WHERE id=".$_SESSION["loggedin"];
$user=$connection ->query($sql);

$sql="SELECT * FROM tweet WHERE id=".$_SESSION["loggedin"];
$tweet=$connection ->query($sql);


$user=$user->fetch_assoc();


echo "<h2>Strona Uzytkownika<br>". $user['username']."</h2>";
foreach($tweet as $row){
    echo $row['text']."   ".$row['creation_date']."<br>";
}





