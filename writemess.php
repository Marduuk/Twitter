<?php
session_start();
if ($_SESSION['loggedin'] != null && is_numeric($_SESSION['loggedin'])) {
    
} else {
    header('Location: loginpage.php');
}

require('connect.php');
require('messclass.php');
require('class.php');




if($_SERVER['REQUEST_METHOD']=='GET'){ // w sumie nie musze uzywac geta bo jezeli zrobie require to nadal mam wartosc, ale w sumie wiem co bylo klykniete!
   $sender=$_GET['senderId'];
   echo $sender;
   $messId=$_GET['MessageId'];   
   Message::updateMessageById($connection,$messId);   
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    if($_POST['rec']==$_SESSION['loggedin']){
        echo "Gratulujemy masz rozdwojenie jazni!";
        return false;
    }

    $id= User::IdNameSwitch($connection,$_POST['rec']);
      
    $MessToSend= new Message();
    $MessToSend->setRecId($id);
    $MessToSend->setSendId($_SESSION['loggedin']);
    $MessToSend->setText($_POST['text']);
    $MessToSend->saveToDB($connection);
    
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
           <input type='text' name='rec'><br><br>
           Tresc<br>
            <textarea rows="4" cols="45" name='text'></textarea> 
            <input type='submit' value='Wyslij'>
        </form>
        
    </body>
</html>