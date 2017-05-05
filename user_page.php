<?php
session_start();
if ($_SESSION['loggedin'] != null && is_numeric($_SESSION['loggedin'])) {
    
} else {
    header('Location: login_page.php');
}
require('connect.php');
require('src/User_class.php');
require('src/Tweet_class.php');
require('src/Comment_class.php');

if($_SERVER['REQUEST_METHOD']=="GET" && $_GET['Username']!=null){
    $user=$_GET['Username'];
    $UserName=$user;
    echo "<h2>Strona uzytkownika $UserName</h2>";
    $userid=User::IdNameSwitch($connection,$user);
    $user=User::loadUserById($connection,$userid);
}

echo "<a href=writemess.php?UnameFromUserPage=$UserName> napisz do tego uzytkownika</a>";

$tweets=Tweet::loadAllTweetsByUserId($connection,$userid);

foreach($tweets as $row){
    echo "<br>".$row -> getText();
    echo "post ma: ".count(Comment::loadAllCommentsByPostId($connection,$row ->getId()))." komentow";
 
}






