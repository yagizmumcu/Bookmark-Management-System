<?php
require "db.php" ;
//var_dump($_POST);
if ( $_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST) ;  
    $sql = "insert into type (type_name) values (?)" ;
    try{
      $stmt = $db->prepare($sql) ;
      $stmt->execute([$type_name]) ;
      addMessage("Success") ;
    }catch(PDOException $ex) {
       addMessage("Insert Failed!") ;
    }
}

header("Location: main?page=1") ;