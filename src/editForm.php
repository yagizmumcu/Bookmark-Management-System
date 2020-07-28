<style>
    container {
        width: 500px;
    }
</style>
<?php
require "db.php";
$a = $_GET["id"];

$bookmark = $db->query("select *
                            from bookmark, user 
                            where user.id = bookmark.owner and user.id = {$_SESSION["user"]["id"]} and $a = bookmark.id")->fetchAll(PDO::FETCH_ASSOC);
$type = $db->query("select type_name
                    from type")->fetchAll(PDO::FETCH_ASSOC);
?>
<?php foreach ($bookmark as $bm) : ?>
    <div class="container">
        <form action="editBM" method="post">
            <h5 class="center">Edit Bookmark</h5>
            <input type="hidden" name="id" id="id" value="<?= $a ?>">
            <div class="input-field">
                <input id="title" type="text" name="title" value="<?= $bm['title'] ?>">
                <label for="title">Title</label>
            </div>
            <div class="input-field">
                <input id="url" type="text" name="url" value="<?= $bm['url'] ?>">
                <label for="url">URL</label>
            </div>
            <div class="input-field">
                <select id="type_name" name="type_name">
                    <option value="<?= $bm['type_name'] ?>" disabled selected>Choose a category</option>
                    <?php foreach ($type as $t) : ?>
                        <option value="<?= $t['type_name'] ?>"><?= $t["type_name"] ?></option>
                    <?php endforeach; ?>
                </select>
            <div class="input-field">
                <textarea id="note" class="materialize-textarea" name="note"><?= $bm['note'] ?></textarea>
                <label for="note">Notes</label>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Edit
                <i class="material-icons right">send</i>
            </button>
        </form>
    </div>
<?php endforeach ?>


<script>
    $(document).ready(function() {
        $('select').formSelect();
    });
</script>