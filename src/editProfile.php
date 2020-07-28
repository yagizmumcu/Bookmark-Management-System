<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST) ;
    require "db.php";
    extract($_POST);
    try {
        // Validate email, name and password
        $sql = "update user 
        set name = ?, email  = ?, password = ?, profile = ? 
        where user.id = {$_SESSION["user"]["id"]}";

        $stmt = $db->prepare($sql);
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([$name, $email, $hash_password, $profile]);
        $user = $db->query("select * from user where user.id = {$_SESSION["user"]["id"]}")->fetch(PDO::FETCH_ASSOC);
        $_SESSION["user"] = $user;
        addMessage("Profile Updated!");
        header("Location: main?page=1");
        exit;
    } catch (PDOException $ex) {
        addMessage("Profile Update failed!");
        header("Location: main?page=1");
        exit;
    }
}
