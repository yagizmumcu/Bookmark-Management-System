<?php
require "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    $bookmark = $db->query("select * from bookmark where $id = id")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($bookmark as $b) {
        $title = $b["title"];
        $url = $b["url"];
        $note = $b["note"];
        $type_name = $b["type_name"];
    }
    $sql = "insert into bookmark (title, url, note, owner, type_name) values (?,?,?,?,?)";
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute([$title, $url, $note, $owner, $type_name]);
        $s = "update user set notifications = notifications + 1 where user.id = ?";
        try {
            $stmt = $db->prepare($s);
            $stmt->execute([$owner]);
            addMessage("Shared");
        } catch (PDOException $ex) {
            addMessage("Fail");
        }
    } catch (PDOException $ex) {
        addMessage("Fail");
    }
}
header("Location: main?page=1");
