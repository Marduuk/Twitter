<?php
session_start();
if ($_SESSION['loggedin'] != null && is_numeric($_SESSION['loggedin'])) {
    
} else {
    header('Location: loginpage.php');
}

require('connect.php');
require('src/Message_class.php');
require('src/Tweet_class.php');
require('src/User_class.php');


if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['UnameFromUserPage'])) {
    $sender = $_GET['senderId'];
    $messId = $_GET['MessageId'];
    Message::updateMessageById($connection, $messId);
    echo Message::loadMessageById($connection, $messId)->getText();
}

$loggedName = User::IdNameSwitch($connection, $_SESSION['loggedin']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['rec'] == $loggedName) {
        echo "error nie mozna ze soba mailowac";
        
    } else {
        $id = User::IdNameSwitch($connection, $_POST['rec']);
        $MessToSend = new Message();
        $MessToSend->setRecId($id);
        $MessToSend->setSendId($_SESSION['loggedin']);
        $MessToSend->setText($_POST['text']);
        $MessToSend->saveToDB($connection);
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Twitterek</title>
    </head>
    <body>
        <form method='post' action=''>
            Odbiorca<br>
            <input type='text' name='rec' value="<?php
if (isset($_GET['UnameFromUserPage'])) {
    echo $_GET['UnameFromUserPage'];
}
?>">
            <br><br>
            Tresc<br>
            <textarea rows="4" cols="45" name='text'></textarea> 
            <input type='submit' value='Wyslij'>
        </form>

    </body>
</html>