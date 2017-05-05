<?php

session_start();
if ($_SESSION['loggedin'] != null && is_numeric($_SESSION['loggedin'])) {
    
} else {
    header('Location: login_page.php');
}
require('connect.php');
require('src/User_class.php');
require('src/Tweet_class.php');

$currentUser = $_SESSION['loggedin'];
$tweets = Tweet::loadAllTweetsByUserId($connection, $currentUser);
$user = User::IdNameSwitch($connection, $currentUser);

foreach ($tweets as $row) {
    echo $row->getText() . "  " . $row->getCreationDate() . "<br><br>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ObCurrentUser = User::loadUserById($connection, $currentUser);

    switch ($_POST['change']) {
        case 'changeUsername':
            if (!is_numeric($_POST['newUsername'])) {
                $ObCurrentUser->setUsername($_POST['newUsername']);
                $ObCurrentUser->saveToDB($connection);
                if ($ObCurrentUser->saveToDB($connection) == true) {
                    $user = $_POST['newUsername'];
                }
            } else {
                echo "imie uzytkownika nie moze byc numerem";
            }
            break;

        case 'changePassword':

            $hashed = $ObCurrentUser->getHashedPassword();
            $passVeryfiy = password_verify($_POST['actPassword'], $hashed);
            if ($passVeryfiy == true && $_POST['newPassword'] != null) {
                $ObCurrentUser->setPassword($_POST['newPassword']);
                $ObCurrentUser->saveToDB($connection);
            } else {
                echo "bledne haslo albo nie wpisane nowe haslo";
            }


            break;

        case 'changeEmail':

            $sql = "SELECT email FROM users WHERE email='" . $_POST['newEmail'] . "'";
            $result = $connection->query($sql);
            $numrows = mysqli_num_rows($result);
            if ($numrows == 0) {

                $ObCurrentUser->setEmail($_POST['newEmail']);
                $ObCurrentUser->saveToDB($connection);
            } else {
                echo "ten mail jest juz wykorzystany";
            }

            break;
    }
}



echo "<h2>Witaj na swojej stronie " . $user . "!</h2>";

echo<<<END
<form method='post' action=''>
zmien username:
<input type='text' name='newUsername'>
<button type='submit' value="changeUsername" name='change'>Zmien</button>
</form>
<br><br>

<form method='post' action=''>
zmien haslo:<br><br>
aktualne haslo:
<input type='password' name='actPassword'><br>
nowe haslo:
<input type='password' name='newPassword'>
<button type='submit' value="changePassword" name='change'>Zmien</button>
</form>
<br><br>

<form method='post' action=''>
zmien email:
<input type='text' name='newEmail'>
<button type='submit' value="changeEmail" name='change'>Zmien</button>
</form>
<br><br>

<a href='delete_user.php'>Usun konto!</a>
END;






