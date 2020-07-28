<?php
require "db.php";
$s = "update user set notifications = 0 where user.id = ?";
try {
    $stmt = $db->prepare($s);
    $stmt->execute([$_SESSION["user"]["id"]]);
    addMessage("Notifications are cleared!");
    $user = $db->query("select * from user where user.id = {$_SESSION["user"]["id"]}")->fetch(PDO::FETCH_ASSOC);
    $_SESSION["user"] = $user;
    header("Location: main?page=1");
} catch (PDOException $ex) {
    addMessage("Fail!");
}
header("Location: main?page=1");
