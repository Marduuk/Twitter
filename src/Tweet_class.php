<?php

require('connect.php');
class Tweet{
    private $id;
    private $userid;
    private $text;
    private $creationDate;
    
    
    public function __construct() {
    $this->id = -1;
    $this->userid = "";
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
            $row = $result->fetch_assoc();
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
        
        $sql = "SELECT * FROM tweet WHERE id=$userid ORDER BY creation_date DESC";
        $ret = [];
        $result = $connection->query($sql);
      
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
        $sql = "SELECT * FROM tweet ORDER BY creation_date DESC";
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
?>
