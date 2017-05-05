<?php
require('connect.php');
class Comment{
    private $id;
    private $userid;
    private $commentId;
    private $creationDate;
    private $text;
    
    public function __construct(){
        $this ->id=-1;
        $this ->userid='';
        $this ->commentId='';
        $this ->creationDate='';
        $this ->text='';
    }
    
    function setUserid($userid) {
        $this->userid = $userid;
    }

    function setCommentId($commentId) {
        $this->commentId = $commentId;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    function setText($text) {
        $this->text = $text;
    }

    function getId() {
        return $this->id;
    }

    function getUserid() {
        return $this->userid;
    }

    function getCommentId() {
        return $this->commentId;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    function getText() {
        return $this->text;
    }
    static public function loadCommentById($connection,$id){
        
        $sql="SELECT * FROM comment WHERE id=$id";
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $loadedTweet = new Comment();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userid = $row['user_id'];
            $loadedTweet->commentId = $row['tweet_id'];
            $loadedTweet->text = $row['text'];            
            $loadedTweet->creationDate = $row['creation_date'];

            return $loadedTweet;
        }

        return null;   
        
               
        
    }
    static public function loadAllCommentsByPostId($connection,$id){
        $sql="SELECT * FROM comment WHERE tweet_id=$id";
        $result = $connection->query($sql);
        $return=[];
   
        if ($result == true && $result->num_rows >= 1) {
            foreach($result as $row){      
            $loadedTweet = new Comment();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userid = $row['user_id'];
            $loadedTweet->commentId = $row['tweet_id'];
            $loadedTweet->text = $row['text'];            
            $loadedTweet->creationDate = $row['creation_date'];

            $return[]=$loadedTweet;
           
            }
        return $return;
          
        }         
    }
    
    public function saveToDB($connection){
        if ($this->id == -1) {
            $sql = "INSERT INTO comment(user_id,tweet_id, text, creation_date)
                    VALUES ('$this->userid','$this->commentId', '$this->text','$this->creationDate')";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        } 
    }
        
}



