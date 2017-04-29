<?php

require('connect.php');
require('class.php');



$kek=Tweet::loadAllTweets($connection);
var_dump($kek);
print_r($kek);
foreach($kek as $innerObTweet){
    $res=$innerObTweet->getText();    
    echo "<hr>" . $res;
    
}








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
$connection ->close();
$connection = null;

        
        