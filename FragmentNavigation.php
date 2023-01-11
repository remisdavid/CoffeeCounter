<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">CoffeCounter</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php
        if($_SESSION['logged_in']){
          ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="PageConsumption.php">Vypil jsem</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="PageSummary.php">Přehled</a>
        </li>
        <?php
        if ($_SESSION['user_permission_level'] == 1) {
          ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="PageDrink.php">Upravit nápoj</a>
        </li>
        <?php
        }
        ?>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="PageStock.php">Koupil jsem</a>
        </li>
        <?php
        }
        ?>
      </ul>
      <span class="navbar-text">
        <?php
        if(!$_SESSION['logged_in']){
          ?>
          <a class="btn btn-primary" href="PageLogin.php" role="button">Přihlásit se</a>
        <?php
        }else{
        ?>
          <a class="btn btn-dark" href="PageProfile.php" role="button"><?php echo($_SESSION['user_first_name'] . " " . $_SESSION['user_last_name'])?></a>
          <a class="btn btn-outline-danger" href="ToolLogout.php" role="button">Odhlásit se</a>
        <?php
        }
        ?>
      </span>
    </div>
  </div>
</nav>