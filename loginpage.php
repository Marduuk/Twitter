<?php
session_start();
require("connect.php");

function loggValidate(mysqli $connection,$emailINP,$passwordINP){
    //troszke risky ale chyba nie bylo innej drogi zeby walidowac logowanie za ponmoca funkcji 
        $sql="SELECT * FROM users WHERE email='$emailINP'";       
        $result=$connection ->query($sql);
        $result=$result->fetch_assoc();
        $passVeryfiy=password_verify($passwordINP ,$result['hashed_password'] );
            if($passVeryfiy==true && $result['email']!=null) {
                header('Location: indeksik.php');
                $_SESSION['loggedin'] = $result['id'];
                return true;
            }
            else{
                echo "nie udalo sie zalogowac";
                return false;
            }
    
}
    if($_SERVER['REQUEST_METHOD'] =="POST"){
        $emailINP=$_POST['email'];
        $passwordINP=$_POST['password'];
        loggValidate($connection,$emailINP,$passwordINP);

        /*
        $sql="SELECT * FROM users WHERE email='$emailINP'";
        
        $result=$connection ->query($sql);
        $result=$result->fetch_assoc();
        $passVeryfiy=password_verify($passwordINP ,$result['hashed_password'] );
        
        
          if($passVeryfiy==true && $result['email']!=null) {
              echo $result['id'];
            header('Location: indeksik.php');
        //    session();!!!!!!!!!!!!!!
          }
          else{
            echo "nie udalo sie zalogowac";
          }*/
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
    <form action="loginpage.php" method="post">
        Podaj email: 
        <input type="text" name="email">
        <br><br>
        Podaj haslo:  
        <input type="password" name="password">
        <br><br>
        <input type="submit" value="Zaloguj"><br>
        <a href="createuser.php">DOLACZ DO SIATKI INWIGILACJI KURWO</a>
</form>
</body>
</html>
