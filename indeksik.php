<?php

require('connect.php');

$user1= new User();

$user1->setEmail("lol@lole.pl");


$user1 ->saveToDB($conn);

$conn ->close();
$conn=null;

        
        