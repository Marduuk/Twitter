<?php
require("connect.php");
require("src/User_class.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if(!is_numeric($_POST['newUsername'])){
        $email = $_POST['newEmail'];
        $sql = "SELECT email FROM users WHERE email='$email'";
        $result = $connection->query($sql);
        $numrows = mysqli_num_rows($result);

            if ($numrows == 0) {
                $user1 = new User();
                $user1->setUsername($_POST['newUsername']);
                $user1->setEmail($email);
                $user1->setPassword($_POST['newPassword']);
                $user1->saveToDB($connection);
                $lastId = $connection->insert_id;

                    if ($user1->saveToDB($connection) == true) {
                        session_start();            //mozna tak sesje rozpoczynac w kodzie?
                        header('Location: indeksik.php');
                        $_SESSION['loggedin'] = $lastId;
                    }
            }
            elseif ($numrows == 1) {
            echo "Istnieje uzytkownik o takim mejlu";
            }
    }
    else{
        echo "imie uzytkownika nie moze byc numerem :3<br>";
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
        Witaj drogi podrozniku wpisz swoje dane!<br>

        <form action="create_user.php" method="POST">
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
