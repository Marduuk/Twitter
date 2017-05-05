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


$loggedOne = $_SESSION['loggedin'];

$allReceived = Message::loadAllReceivedMessagesByUserId($connection, $loggedOne);
$allSent = Message::loadAllSentMessagesByUserId($connection, $loggedOne);


if ($allReceived != null) {

    foreach ($allReceived as $row) {


        $textFrag = substr($row->getText(), 0, 5);
        $sender = $row->getSendId();
        $datUser = User::loadUserById($connection, $sender);
        $datUser = $datUser->getUsername();

        $messId = $row->getId();
        $readOrNot = $row->getReadOrNot();

        if ($readOrNot == '0') {
            echo "<strong>";
        }

        echo "<a href='writemess.php?senderId=$sender&senderName=$datUser&MessageId=$messId'>Wiadomosc od uzytkownika " . $datUser . ": " . $textFrag . "...</a><br>";

        if ($readOrNot == '0') {
            echo "</strong>";
        }
    }
}


            