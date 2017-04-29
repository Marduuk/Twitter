<?php

//trzymaj to w pliku src ale to pozniej teraz koduje :3 IMPORTANT slajd 13 

class User {

    private $id;
    private $username;
    private $hashedPassword;
    private $email;

    public function __construct() {
        $this->id = -1;
        $this->username = "";
        $this->email = "";
        $this->hashedPassword = "";
    }

    public function setUsername($Uname) {
        $this->username = $Uname;
    }

    public function setEmail($mail) {
        $this->email = $mail;
    }
    public function getPassword(){
        return $this -> password; // or hashed?
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPassword($newPassword) {
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
    }

    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {
            $sql = "INSERT INTO users(username, email, hashed_password)
                    VALUES ('$this->username', '$this->email', '$this->hashedPassword')";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        } else {
            $sql = "UPDATE users SET username='$this->username',
                    email='$this->email',
                    hashed_password='$this->hashedPassword'
                    WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
            return false;
        }
    }

    static public function loadUserById(mysqli $connection, $id) {
        $sql = "SELECT * FROM users WHERE id=$id";
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {
            var_dump($result);
            $row = $result->fetch_assoc();
            var_dump($row);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];

            return $loadedUser;
        }

        return null;
    }

    static public function loadAllUsers(mysqli $connection) {
        $sql = "SELECT * FROM users";
        $ret = [];
        $result = $connection->query($sql);
        var_dump($result);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashedPassword = $row['hashed_password'];
                $loadedUser->email = $row['email'];
                $ret[] = $loadedUser;
            }
        }

        return $ret;
    }

    public function delete(mysqli $connection) {
        if ($this->id != -1) {
            $sql = "DELETE FROM Users WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }
}


class Tweet{
    private $id;
    private $userid;
    private $text;
    private $creationDate;
    
    
    public function __construct() {
    $this->id = -1;
    $this->user_id = "";
    $this->text = "";
    $this->creationDate = "";
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUserid() {
        return $this->userid;
    }

    public function getText() {
        return $this->text;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setUserid($userid) {
        $this->userid = $userid;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }
    static public function loadTweetById(mysqli $connection,$id){
       
        $sql = "SELECT * FROM tweet WHERE tweet_id=$id";
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {
            var_dump($result);
            $row = $result->fetch_assoc();
            var_dump($row);
            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['tweet_id'];
            $loadedTweet->userid = $row['id'];
            $loadedTweet->text = $row['text'];
            $loadedTweet->creationDate = $row['creation_date'];

            return $loadedTweet;
        }

        return null;    
    }
    static public function loadAllTweetsByUserId(mysqli $connection,$userid){
        
                $sql = "SELECT * FROM tweet WHERE id=$userid";
        $ret = [];
        $result = $connection->query($sql);
        var_dump($result);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedTweets = new Tweet();
                $loadedTweets->id = $row['tweet_id'];
                $loadedTweets->userid = $row['id'];
                $loadedTweets->text = $row['text'];
                $loadedTweets->creationDate = $row['creation_date'];
                $ret[] = $loadedTweets;
            }
        }

        return $ret;
        
    }
    static public function loadAllTweets(mysqli $connection){
        $sql = "SELECT * FROM tweet";
        $ret = [];
        $result = $connection->query($sql);
    
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedUser = new Tweet();
                $loadedUser->id = $row['tweet_id'];
                $loadedUser->userid = $row['id'];
                $loadedUser->text = $row['text'];
                $loadedUser->creationDate = $row['creation_date'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
        
    }

   public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {
            $sql = "INSERT INTO tweet(text,id, creation_date)
                    VALUES ('$this->text','$this->userid', '$this->creationDate')";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        } 
    }
    
}
