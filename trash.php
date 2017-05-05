<?php
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
      } */

            /*
              $hm=new Comment();
              $hm ->loadAllCommentsByPostId($connection,4);
              var_dump($hm);
              $comm= Comment::loadAllCommentsByPostId($connection,4);

              var_dump($comm); */

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
/*
$vivat=new Message();
$vivat->setRecId(6);
$vivat->setSendId(3);
$vivat->setText('nie tedst');


var_dump($vivat);
$vivat->saveToDB($connection);
*/

//$check=Message::loadAllReceivedMessagesByUserId($connection,6);
//var_dump($check);

//$check=Message::loadMessageById($connection,20);
//var_dump($check);
//$res=Comment::loadCommentById($connection,1);
//$res=Comment::loadAllCommentsByPostId($connection,4);
//var_dump($res);

/*
$com=new Comment();
$com->setUserid(4);
$com->setCommentId(4);
$com->setCreationDate('2017-11-11');
$com->setText('Hakuna Matata, jak check check to brzmi');
var_dump($com);
$com->saveToDB($connection);
*/
        
        /*
                $loadedMess = new Message();
                $loadedMess->id = $row['id'];
             
                $loadedMess->recId = $row['rec_id'];
                $loadedMess->sendId = $row['send_id'];
                $loadedMess->text = $row['text'];
                $loadedMess->readOrNot = $row['read_or_not'];
         * 
         */