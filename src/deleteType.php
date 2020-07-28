<?php
  require "db.php" ;

  $type = $_GET['type'] ?? "";
  try {
    $stmt = $db->prepare("delete from type where type_name = :type") ;
    $stmt->execute(["type" => $type]) ;
    addMessage("Success") ;
} catch(PDOException $ex) {
    addMessage("Failed!") ;
}
header("Location: main?page=1") ;
