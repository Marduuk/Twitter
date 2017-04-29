<?php
require("connect.php");
require("class.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
 
    $username=$_POST['newUsername'];
    $email=$_POST['newEmail'];
    $password=$_POST['newPassword'];
   
    $sql="SELECT email FROM users WHERE email='$email'";
    $result=$connection ->query($sql);
    $numrows = mysqli_num_rows($result);

        if ($numrows==0){
            $user1= new User();
            $user1->setUsername("$username");
            $user1->setEmail("$email");
            $user1->setPassword("$password");      
            $user1 ->saveToDB($connection); 
           
        }
        elseif($numrows==1){
            echo "Istnieje uzytkownik o takim mejlu";
        }
        else{
            echo "Zapora antyhackerska? :3";
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
    Witaj drogi podrozniku wpisz ponizej mejla no i kurde no haslo to cie dodamy do ziomeczkow
    
    <form action="createuser.php" method="POST">
        Podaj username: 
        <input type="text" name="newUsername">
        <br><br>
        Podaj email: 
        <input type="text" name="newEmail">
        <br><br>
        Podaj haslo:  
        <input type="password" name="newPassword">
        <br><br>
        <input type="submit" value="Stworz nowego uzytkownika"><br>

</form>
</body>
</html>
