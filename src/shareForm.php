<?php
$bid = $_GET["id"];
require "db.php";
$user = $db->query("select * from user where user.id != {$_SESSION["user"]["id"]} ")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <form action="shareBM" method="post">
    <input type="hidden" name="id" value="<?= $bid ?>">
        <div class="input-field">
            <select id="owner" name="owner">
                <option value="" disabled selected>Choose a user to share bookmark</option>
                <?php foreach ($user as $u) : ?>
                    <option value="<?= $u['id'] ?>"><?= $u["name"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Share
            <i class="material-icons right">share</i>
        </button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('select').formSelect();
    });
</script>