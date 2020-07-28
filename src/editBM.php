<?php
require "db.php ";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    $sql = "update bookmark
            set title = ?, url = ?, type_name = ?, note = ? 
            where bookmark.id = ?";
            
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute([$title, $url, $type_name, $note, $id]);
        addMessage("Success!");
    } catch (PDOException $ex) {
        addMessage("Failed!");
    }
    header("Location: main?page=1");
}

?>
