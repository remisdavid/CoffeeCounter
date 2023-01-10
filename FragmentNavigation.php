<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">CoffeCounter</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="PageConsumption.php">Přidat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="PageSummary.php">Přehled</a>
        </li>
      </ul>
      <span class="navbar-text">
        <?php
        if(!isset($_SESSION['logged_in'])){
          ?>
          <a class="btn btn-primary" href="PageLogin.php" role="button">Přihlásit se</a>
        <?php
        }else{
        ?>

        <button type="button" class="btn btn-dark"><?php echo($_SESSION['user_first_name'] . " " . $_SESSION['user_last_name'])?></button>
        <?php
        }
        ?>
      </span>
    </div>
  </div>
</nav>