<?php

 $dsn = "mysql:host=localhost;dbname=bms;charset=utf8mb4;port=3308" ;
 $user = "std" ; // "root"
 $pass = "" ; // "", "root"

 try {
     $db = new PDO($dsn, $user, $pass) ;
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

 } catch( PDOException $ex) {
     echo $ex->getMessage() ;
     echo "<p>Error occured try later.</p>";
     exit ; 
 }