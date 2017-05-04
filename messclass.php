<?php
require('connect.php');

class Message{
    private $id;
    private $recId;
    private $sendId;
    private $text;
    private $readOrNot;
    
    
    public function __construct(){
        $this->id=-1;
        $this->recId='';
        $this->sendId='';
        $this->text='';
        $this->readOrNot=0;
    }
    function setRecId($recId) {
        $this->recId = $recId;
    }

    function setSendId($sendId) {
        $this->sendId = $sendId;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setReadOrNot($readOrNot) {
        $this->readOrNot = $readOrNot;
    }

    function getId() {
        return $this->id;
    }

    function getRecId() {
        return $this->recId;
    }

    function getSendId() {
        return $this->sendId;
    }

    function getText() {
        return $this->text;
    }

    function getReadOrNot() {
        return $this->readOrNot;
    }

    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {
            $sql = "INSERT INTO message(rec_id, send_id, text,read_or_not)
                    VALUES ('$this->recId','$this->sendId', '$this->text','$this->readOrNot')";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                
                return true;
            }
            echo "Nie ma takiego uzytkownika";
        } 
    }
    static public function loadAllReceivedMessagesByUserId($connection,$userid){
        
        $sql = "SELECT * FROM message WHERE rec_id=$userid";
        $ret = [];
        $result = $connection->query($sql);
  
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedMess = new Message();
                $loadedMess->id = $row['id'];
             
                $loadedMess->recId = $row['rec_id'];
                $loadedMess->sendId = $row['send_id'];
                $loadedMess->text = $row['text'];
                $loadedMess->readOrNot = $row['read_or_not'];
                $ret[] = $loadedMess;

               
            }
            return $ret;
        }
    }
    static public function loadAllSentMessagesByUserId($connection,$userid){ //sa identyczne mozna je zrobic jakos madrze ale czy warto sie meczyc?
        
        $sql = "SELECT * FROM message WHERE send_id=$userid";
        $ret = [];
        $result = $connection->query($sql);
    
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedMess = new Message();
                $loadedMess->id = $row['id'];
       
                $loadedMess->recId = $row['rec_id'];
                $loadedMess->sendId = $row['send_id'];
                $loadedMess->text = $row['text'];
                $loadedMess->readOrNot = $row['read_or_not'];
                $ret[] = $loadedMess;
          
               
            }
            return $ret;
        }          
  

    }
    static public function loadMessageById($connection,$id){
        
        $sql = "SELECT * FROM message WHERE id=$id";
      
        $result = $connection->query($sql);
      
        $row=$result -> fetch_assoc();
    
        if ($result == true && $result->num_rows != 0) {

                $loadedMess = new Message();
                $loadedMess->id = $row['id'];
              
                $loadedMess->recId = $row['rec_id'];
                $loadedMess->sendId = $row['send_id'];
                $loadedMess->text = $row['text'];
                $loadedMess->readOrNot = $row['read_or_not'];
              
         
               
            
            return $loadedMess;
        }      
        
    
    }
        static public function updateMessageById($connection,$id){
        
        $sql = "UPDATE message SET read_or_not=1 WHERE id=$id";
      
        $connection->query($sql);
      
        }
   
}
/*
$vivat=new Message();
$vivat->setRecId(6);
$vivat->setSendId(3);
$vivat->setText('nie tedst');


var_dump($vivat);
$vivat->saveToDB($connection);
*/

//$check=Message::loadAllReceivedMessagesByUserId($connection,6);
//var_dump($check);

//$check=Message::loadMessageById($connection,20);
//var_dump($check);

 
 