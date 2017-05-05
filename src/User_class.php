<?php
require('connect.php');
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
        return $this -> password; // z haslami tutaj nie pomieszalem?
    }
    public function getHashedPassword(){
        return $this ->hashedPassword;
    }
    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }
    public function getId() {
        return $this->id;
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
           
            $row = $result->fetch_assoc();
            
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

    public function delete($connection) {
        if ($this->id != -1) {
            $sql = "DELETE FROM users WHERE id='$this->id'";//id w funkcji i usunac this 'winno ino dzialac mocium panie, albo i nie...
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }
    
   static public function IdNameSwitch($connection,$idOrUname){
        if(is_numeric($idOrUname)){           
            $user=User::loadUserById($connection,$idOrUname); //zmiana usera na idka
            return $user->getUsername();
        }
        if(is_string($idOrUname)){
            $sql = "SELECT id FROM users WHERE username='$idOrUname'";
            $result = $connection->query($sql);
                if ($result == true) {
                    $row = mysqli_fetch_array($result);
                     return $row['id'];                     
            }
        }
    }
}
