<?php

$servername='localhost';
$username='root';
$password='coderslab';
$basename='Warsztat';

$connection = new mysqli($servername,$username,$password,$basename);

/*
function loggValidate($emailINP,$passwordINP){
    global $connection; //troszke risky ale chyba nie bylo innej drogi zeby walidowac logowanie za ponmoca funkcji 
        $sql="SELECT * FROM users WHERE email='$emailINP'";       
        $result=$connection ->query($sql);
        $result=$result->fetch_assoc();
        $passVeryfiy=password_verify($passwordINP ,$result['hashed_password'] );
            if($passVeryfiy==true && $result['email']!=null) {
                header('Location: indeksik.php');
            }
            else{
                echo "nie udalo sie zalogowac";
            }
    
}

*/