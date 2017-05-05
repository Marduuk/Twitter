<?php
session_start();
if ($_SESSION['loggedin'] != null && is_numeric($_SESSION['loggedin'])) {
    
} else {
    header('Location: login_page.php');
}
require('connect.php');
require('src/Tweet_class.php');
require('src/User_class.php');
require('src/Comment_class.php');
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
        <a href="logg_out.php">Wyloguj<a/>
            <br><br>
            <a href='messages_page.php'>przejdz do wiadomosci</a><br><br>
            <a href='your_page.php'>przejdz na swoja strone</a><br><br>
            Tweetnij!
            <form action='indeksik.php' method='post'>
                <input type='text' name='tweet' maxlength="140">
                <button type='submit' value='TweetUp' name='sub'>Tweet it</button><br><br><br>
            </form>
            <?php
            $tweetNum = count(Tweet::loadAllTweets($connection));

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                switch ($_POST['sub']) {
                    case 'TweetUp':

                        $tweetToSave = new Tweet();
                        $ActDate = new DateTime();
                        $tweetToSave->setText($_POST['tweet']);
                        $tweetToSave->setUserid($_SESSION['loggedin']);
                        $tweetToSave->setCreationDate(($ActDate->format('Y-m-d h:i:s')));
                        $tweetToSave->saveToDB($connection);
                        break;

                    case is_numeric($_POST['sub']):
                        $comment = new Comment();
                        $comment->setUserid($_SESSION['loggedin']);
                        $comment->setCommentId($_POST['sub']);
                        $comment->setText($_POST['comment']);
                        $ActDate = new DateTime();
                        $comment->setCreationDate(($ActDate->format('Y-m-d h:i:s')));
                        $comment->saveToDB($connection);
                        break;
                }
            }
            

            $allTweets = Tweet::loadAllTweets($connection);

            echo "<table border='1px solid black'>";
            foreach ($allTweets as $innerObTweet) {
                $res = $innerObTweet->getText();
                $res1 = User::loadUserById($connection, $innerObTweet->getUserid());
                $res1 = $res1->getUsername();
                echo "<tr><td>" . $res . "</td><td>  " . "<a href='user_page.php?Username=$res1'>$res1</a>" . "</td></tr>";
                $comm = Comment::loadAllCommentsByPostId($connection, ($innerObTweet->getId()));
                if ($comm != null) {
                    foreach ($comm as $row) {

                        $thisUser = User::loadUserById($connection, $row->getUserid());
                        $thisUname = $thisUser->getUsername();
                        echo "<tr><td>" . "<a href='user_page.php?Username=$thisUname'>$thisUname</a>" . ":  " . $row->getText() . "</td></tr>";
                    }
                }
                echo "<tr><td>"
                . "<form action='indeksik.php' method='post'> "
                . "<input type='text' name='comment' maxlength='60'>"
                . "<button type='submit' value=" . $innerObTweet->getId() . " name='sub'>Komentuj</button>"
                . "</form>"
                . "</td></tr>";
            }

            echo "</table>"; 
            ?>
    </body>
</html>



<?php
$connection->close();
$connection = null;

?>
