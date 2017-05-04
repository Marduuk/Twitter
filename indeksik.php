<?php
session_start();
if ($_SESSION['loggedin'] != null && is_numeric($_SESSION['loggedin'])) {
    
} else {
    header('Location: loginpage.php');
}
require('connect.php');
require('class.php');
require('commentclass.php');

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

        Tweetnij!
         <form action='indeksik.php' method='post'>
             <input type='text' name='tweet'>
             <button type='submit' value='TweetUp' name='sub'>Tweet it</button><br>
         </form>
<?php
    $tweetNum=count(Tweet::loadAllTweets($connection));
             
        if ($_SERVER['REQUEST_METHOD'] == "POST") { 
            switch($_POST['sub']){
            case 'TweetUp':
                        
                $tweetToSave= new Tweet();
                $ActDate=new DateTime();    
                $tweetToSave->setText($_POST['tweet']);
                $tweetToSave->setUserid($_SESSION['loggedin']);
                $tweetToSave->setCreationDate(($ActDate ->format('Y-m-d')));
        
                $tweetToSave-> saveToDB($connection);
            break;
           
            case is_numeric($_POST['sub']):
                $comment=new Comment();
                $comment->setUserid($_SESSION['loggedin']);
                $comment-> setCommentId($_POST['sub']);
                $comment-> setText($_POST['comment']);
                $ActDate=new DateTime();
                $comment->setCreationDate(($ActDate ->format('Y-m-d')));
                
                $comment->saveToDB($connection);
            break;    
            }  
        }
 
        
        /*
        $hm=new Comment();
        $hm ->loadAllCommentsByPostId($connection,4);
        var_dump($hm);
        $comm= Comment::loadAllCommentsByPostId($connection,4);

        var_dump($comm); */
        $kek = Tweet::loadAllTweets($connection);
       
    echo "<table border='1px solid black'>";
        foreach ($kek as $innerObTweet) {
            $res = $innerObTweet->getText();
            $res1 = User::loadUserById($connection, $innerObTweet->getUserid());
            $res1 = $res1->getUsername();
            echo "<tr><td>" . $res . "</td><td>  " . $res1 . "</td></tr>";
     
            $comm=Comment::loadAllCommentsByPostId($connection,($innerObTweet->getId()));
                    
              if($comm!=null){
                foreach($comm as $row){
               
                $thisUser=User::loadUserById($connection,$row->getUserid());                                
                   echo "<tr><td>".$thisUser->getUsername(). ":  ".   $row->getText() ."</td></tr>";                        
                }                 
              }
                echo "<tr><td>"
              . "<form action='indeksik.php' method='post'> "
              . "<input type='text' name='comment'>"
             // . "<input type='submit' value='Komentuj!'>"
              . "<button type='submit' value=".$innerObTweet->getId()." name='sub'>Komentuj</button>"
              . "</form>"
              . "</td></tr>";
                }

        echo "</table>"; //sort by creation date
        
        
        ?>
    </body>
    </html>



        <?php
        $connection->close();
        $connection = null;
        

/*
  $users=User::loadAllUsers($connection);
  var_dump($users);
  $user1 ->setUsername("Honoratka");

  $user1 -> saveToDB($connection);
 */
/*
  if($user1 ->delete($connection)){
  echo "uzytkownik usuniety";
  }
  else{
  echo "nie usunieto";
  }

 */
/*
  $user1 = User::loadUserByID($connection,1);
  var_dump($user1);
 */

/*
  $user1= new User();

  $user1->setUsername("test");
  $user1->setEmail("test@test.test");
  $user1->setPassword('test');


  $user1 ->saveToDB($connection);
 */
/*
  $users=User::loadAllUsers($connection);
  var_dump($users);
 */
/*
  $res=Tweet::loadTweetById($connection,1);
  var_dump($res);
  echo "<hr>";

  $lol=Tweet::loadAllTweetsByUserId($connection,2);
  var_dump($lol);
  echo "<hr>";
  $kek=Tweet::loadAllTweets($connection);
  var_dump($kek);


  $ActualTime= new DateTime();


  $tweet= new Tweet($connection);
  $tweet ->setText("Bogurodzica dzieeewicaaaaaaaaa");
  $tweet ->setUserid(4);
  $tweet ->setCreationDate($ActualTime ->format('Y-m-d'));

  $tweet -> saveToDB($connection);
 */
 ?>
