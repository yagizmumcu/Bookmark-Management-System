<?php
$register_link = ["home", "loginForm"];
$login_link = ["home", "registerForm"];
$main_link = ["main", "editBM", "profileForm", "shareForm"];
?>

<nav>
  <div class="nav-wrapper">
    <a href="home?page=1" class="brand-logo"><i class="material-icons left hide-on-med-and-down">home</i>BMS</a>
    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

    <!-- Menu Items -->
    <?php
    $menu_items = [
      "desktop" => '<ul id="nav-mobile" class="right hide-on-med-and-down">',
      "mobile" => '<ul class="sidenav" id="mobile-demo">'
    ];
    ?>

    <?php foreach ($menu_items as $type => $menu) : ?>
      <?= $menu ?>
      <?php if ($type == "mobile") : ?>
        <li class="red-text" style="margin-left: 3em; margin-top:2em">BMS v1.0</li>
        <li class="divider"></li>
      <?php endif ?>
      <?php if (in_array($page, $register_link)) : ?>
        <li>
          <a href="registerForm"><i class="material-icons left">person_add</i>Register</a>
        </li>
      <?php endif ?>

      <?php if (in_array($page, $login_link)) : ?>
        <li>
          <a href="loginForm"><i class="material-icons left">directions_run</i>Sign in</a>
        </li>
      <?php endif ?>

      <?php if (in_array($page, $main_link)) : ?>
        <li>
          <a href="resetAlert"><i class="material-icons left">notifications</i><span class="new badge"><?= $_SESSION["user"]["notifications"] ?></span></a>
        </li>
        <li>
          <a href="profileForm"><i class="material-icons left">face</i><?=$_SESSION["user"]["name"] ?></a>
        </li>
        <li>
          <a href="logout"><i class="material-icons left">exit_to_app</i>Logout</a>
        </li>
      <?php endif ?>
      </ul>
    <?php endforeach ?>
  </div>
</nav>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);
  });
</script>