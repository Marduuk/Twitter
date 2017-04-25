<?php

class User{
   private $id;
   private $username;
   private $password;
   private $email;
    
  public function __construct() {
        $this->id = -1;
        $this->username ="";
        $this->email ="";
        $this->hashedPassword ="";

    }
    
public function setUsername($Uname){
    $this -> username=$Uname;
}
public function setEmail($mail){
    $this -> email=$mail;
}



public function setHashedPassword($password){

    $this ->hashedPassword = password_hash($password, PASSWORD_BCRYPT);        
}     
        
        
        
        
public function saveToDB(mysqli $connection){

if($this->id == -1){

//Saving new user to DB

$sql = "INSERT INTO Users(username, email, hashed_password)

VALUES ('$this->username', '$this->email', '$this->hashedPassword')";

$result = $connection->query($sql);

if($result == true){

$this->id = $connection->insert_id;

return true;

}

}

return false;
}
}