<?php

require "db.php";

// To remember sort between pages.
// You can use the same technique for page numbers in pagination.
if (!isset($_GET["sort"])) {
  $sort = $_SESSION["sort"] ?? "title";
  $page = 1;
} else {
  $sort = $_GET["sort"];
  $_SESSION["sort"] = $sort;
  $page = 1;
}

if (!isset($_GET["type"])) {
  $_GET["type"] = "No Type";
  $page = 1;
} else {
  $page = 1;
}
if (!isset($_GET["page"])) {
  $page =  1;
} else {
  $page = $_GET["page"];
}

$users = $db->query("select * from user order by name")->fetchAll(PDO::FETCH_ASSOC);
$bookmarks = $db->query("select user.id uid, bookmark.id bid, name, title, note, created, url
                            from bookmark, user 
                            where user.id = bookmark.owner and user.id = {$_SESSION["user"]["id"]}
                            order by $sort")->fetchAll(PDO::FETCH_ASSOC);
$type =  $db->query("select * from type order by type_name")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["search"])) {
  $bookmarks =  $db->query("select user.id uid, bookmark.id bid, name, title, note, created, url, type_name 
                            from bookmark, user 
                            where user.id = bookmark.owner and user.id = {$_SESSION["user"]["id"]} AND (title LIKE '%{$_GET["search"]}%' OR note LIKE '%{$_GET["search"]}%')")->fetchAll(PDO::FETCH_ASSOC);
  $page = 1;
}

?>

<!-- Floating button at the bottom right -->
<div class="fixed-action-btn">
  <a class="btn-floating btn-large red modal-trigger z-depth-2" href="#add_form">
    <i class="large material-icons">add</i>
  </a>
</div>

<!-- Main Table for all bookmarks -->
<div class="row">
  <div class="col s2">
    <form action="main" method="GET">
      <div class="input-field">
        <i class="material-icons prefix">search</i>
        <input id="search" type="text" name="search">
        <label for="search">Search</label>
        <button class="btn waves-effect waves-light center-align" type="submit" name="action">Search

        </button>
      </div>
    </form>

    <div class="collection">
      <a href="?type=No%20Type&page=1" class="collection-item <?php if ('No Type' == $_GET['type']) echo 'active'; ?> ">All</a>
      <?php foreach ($type as $t) : ?>
        <a href="?type=<?= $t['type_name'] ?>&page=1" class="collection-item <?php if ($t['type_name'] == $_GET['type']) echo 'active'; ?> "><?= $t["type_name"] ?></a>
      <?php endforeach ?>
    </div>
    <a class="btn-floating btn-medium blue modal-trigger" href="#add_type">
      <i class="medium material-icons">add</i>
    </a>
    <a href="deleteType?type=<?= $_GET['type'] ?>" class="btn-floating btn-medium blue modal-trigger">
      <i class="medium material-icons">remove</i>
    </a>
  </div>

  <div class="col s10">
    <table class="striped" id="main-table">
      <tr style="height:60px" class="grey lighten-5">
        <th class="title">
          <a href="?sort=title&page=1">Title
            <?= $sort == "title" ? "<i class='material-icons'>arrow_drop_down</i>" : "" ?>
          </a>
        </th>
        <th class="note">
          <a href="?sort=note&page=1">Note
            <?= $sort == "note" ? "<i class='material-icons'>arrow_drop_down</i>" : "" ?>
          </a>
        </th>
        <th class="action">Actions</th>
      </tr>
      <?php
      $row = 0;
      $record_number = 4;
      foreach ($bookmarks as $r) :
        $row++;
      endforeach;
      $start = ($page - 1) * $record_number;
      $i = $start;
      $totalPage = (int) ceil($row / $record_number);
      while ($i < $start + $record_number && $i < $row) {
        $bm = $bookmarks[$i];
        echo "<tr id='row$bm[bid]'>";
        echo "<td><span class='truncate'><a href='$bm[url]'>$bm[title]</a></span></td>";
        echo "<td><span class='truncate'>$bm[note]</span></td>";
        echo "<td class='action'>";
        echo "<a href='$bm[bid]' class='bms-delete btn-small'><i class='material-icons'>delete</i></a>";
        echo "<a class='btn-small bms-view' href='$bm[bid]'><i class='material-icons'>visibility</i></a>";
        echo "<a href='editForm?id=$bm[bid]' class='btn-small'><i class='material-icons'>edit</i></a>";
        echo "<a href='shareForm?id=$bm[bid]' class='btn-small'><i class='material-icons'>share</i></a>";
        echo "</td>";
        echo "</tr>";
        $i = $i + 1;
      }
      ?>
    </table>
  </div>
</div>

<!-- All modal bookmarks in detail to show after clicking view buttons -->
<div id="bm-detail" class="modal">
  <div class="modal-content">
    <table class="striped">
      <tr>
        <td>Title:</td>
        <td id="detail-title"></td>
      </tr>
      <tr>
        <td>Note:</td>
        <td id="detail-note"></td>
      </tr>
      <tr>
        <td>URL:</td>
        <td id="detail-url"></td>
      </tr>
      <tr>
        <td>Date:</td>
        <td id="detail-date"></td>
      </tr>
      <tr>
        <td>Type:</td>
        <td id="detail-type_name"></td>
      </tr>
    </table>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
  </div>
</div>

<!-- Modal Form for new Type -->
<div id="add_type" class="modal">
  <form action="addType" method="post">
    <div class="modal-content">
      <div class="input-field">
        <input id="type_name" type="text" name="type_name">
        <label for="type_name">Only use letters and charactes!</label>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn waves-effect waves-light" type="submit" name="action">Add
        <i class="material-icons right">send</i>
      </button>
    </div>
  </form>
</div>

<!-- Modal Form for new Bookmark -->
<div id="add_form" class="modal">
  <?php $a = $_GET["type"] ?>
  <form action="addBM" method="post">
    <div class="modal-content">
      <h5 class="center">New Bookmark</h5>
      <input type="hidden" name="owner" value="<?= $_SESSION["user"]["id"] ?>">
      <div class="input-field">
        <input id="title" type="text" name="title">
        <label for="title">Title</label>
      </div>
      <div class="input-field">
        <input id="url" type="text" name="url">
        <label for="url">URL</label>
      </div>
      <div class="input-field">
        <textarea id="note" class="materialize-textarea" name="note"></textarea>
        <label for="note">Notes</label>
      </div>
    </div>
    <input type="hidden" id="type_name" name="type_name" value="<?= $a ?>">
    <div class="modal-footer">
      <button class="btn waves-effect waves-light" type="submit" name="action">Add
        <i class="material-icons right">send</i>
      </button>
    </div>
  </form>
</div>

<?php
$row_num = 0;
foreach ($bookmarks as $r) :
  $row_num++;
endforeach;
$page_num = ceil($row_num / 4);
echo "<ul class='pagination'>";
if ($page == 1)
  echo "<li class='disabled'><a><i class='material-icons'>chevron_left</i></a></li>";
else {
  $tmp =  $page - 1;
  echo "<li class='waves-effect'><a href='?page=$tmp'><i class='material-icons'>chevron_left</i></a></li>";
}
for ($b = 1; $b <= $page_num; $b++) {
  if ($page == $b)
    echo "<li class= active><a>$b</a></li>";
  else
    echo "<li><a href='?page=$b'>$b</a></li>";
}
if ($page == $page_num) {
  $tmp_end =  $page + 1;
  echo "<li class='disabled'><a><i class='material-icons'>chevron_right</i></a></li>";
} else {
  $tmp_end =  $page + 1;
  echo "<li class='waves-effect'><a href='?page=$tmp_end'><i class='material-icons'>chevron_right</i></a></li>";
}
echo "</ul>";
?>

<div class="center hide" id="loader">
  <div class="preloader-wrapper small active">
    <div class="spinner-layer spinner-green-only">
      <div class="circle-clipper left">
        <div class="circle"></div>
      </div>
      <div class="gap-patch">
        <div class="circle"></div>
      </div>
      <div class="circle-clipper right">
        <div class="circle"></div>
      </div>
    </div>
  </div>
</div>

<!-- Initialization of modal elements and listboxes -->
<script>
  var instanceDetail;
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
    instanceDetail = M.Modal.init(document.getElementById("bm-detail"));

    elems = document.querySelectorAll('select');
    M.FormSelect.init(elems);
  });


  $(function() {
    // page is loaded
    //alert("jquery works");
    $(".bms-delete").click(function(e) {
      e.preventDefault();
      // alert("Delete Clicked") ;
      let id = $(this).attr("href");
      //alert( id + " clicked");
      $("#loader").toggleClass("hide"); // show loader.
      $.get("delete", {
          "id": id
        },
        function(data) {
          console.log(data);
          $("#row" + id).remove(); // removes from html table.
          $("#loader").toggleClass("hide"); // hide loader.
          M.toast({
            html: 'Deleted!',
            classes: 'rounded',
            displayLength: 1000
          });
        },
        "json"
      );
    });

    $(".bms-view").click(function(e) {
      e.preventDefault();
      let id = $(this).attr("href");
      console.log("bms view clicked id " + id);
      $("#loader").toggleClass("hide"); // show loader.
      $.get("getBM", {
          "id": id
        },
        function(data) {
          console.log(data);
          $("#detail-title").text(data.title);
          $("#detail-url").text(data.url);
          $("#detail-note").text(data.note);
          $("#detail-date").text(data.created);
          $("#detail-type_name").text(data.type_name);
          instanceDetail.open();
          $("#loader").toggleClass("hide"); // hide loader.
        }, "json"
      )
    });
  });
</script>