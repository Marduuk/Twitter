<?php
session_start();
if ($_SESSION['loggedin'] != null && is_numeric($_SESSION['loggedin'])) {
    
} else {
    header('Location: loginpage.php');
}
require('connect.php');
require('messclass.php');
require('class.php');


$loggedOne=$_SESSION['loggedin'];

$allReceived=Message::loadAllReceivedMessagesByUserId($connection,$loggedOne);
$allSent=Message::loadAllSentMessagesByUserId($connection,$loggedOne);

//var_dump($allSent);

        if ($allReceived != null) {
            
            foreach ($allReceived as $row) {
             
               
               $textFrag = substr($row->getText(), 0, 5);
               $sender=$row ->getSendId();
               $datUser=User::loadUserById($connection,$sender);
               $datUser=$datUser->getUsername();
              
               $messId=$row->getId();
               $readOrNot=$row ->getReadOrNot();
               
            if($readOrNot == '0'){
                   echo "<strong>";
            }
            
                echo "<a href='writemess.php?senderId=$sender&senderName=$datUser&MessageId=$messId'>Wiadomosc od uzytkownika ". $datUser . ": ".$textFrag."...</a><br>";
                
            if($readOrNot == '0'){
                   echo "</strong>";
            }        
            }
        }

        /*
                $loadedMess = new Message();
                $loadedMess->id = $row['id'];
             
                $loadedMess->recId = $row['rec_id'];
                $loadedMess->sendId = $row['send_id'];
                $loadedMess->text = $row['text'];
                $loadedMess->readOrNot = $row['read_or_not'];
         * 
         */
            