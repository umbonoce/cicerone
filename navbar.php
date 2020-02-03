<nav class="collapse navbar-collapse navbar-right" role="Navigation">
  <ul id="nav" class="nav navbar-nav navigation-menu">
    <li><a href="/index.php"><h4> <i class="fas fa-home"></i> Homepage</h4></a></li>
    <li><a href="/inserisci_attivita.php"><h4> <i class="fas fa-plus-circle"></i> Inserisci Attività</h4></a></li>
    <li><a href="/ricerca_attivita.php"><h4> <i class="fas fa-search"></i> Ricerca Attività</h4></a></li>
    <li>
      <a href="<?php echo isset($_SESSION['id']) ? '/profilo.php?id='. $_SESSION['id'] : '/login.php' ?>">
        <h4>
          <?php echo isset($_SESSION['id']) ? '<i class="fas fa-user"></i> Ciao ' . $_SESSION['nome'] . '!' : ' <i class="fas fa-sign-in-alt"></i> Login' ?>
        </h4></a> </li>
      </ul>
    </nav>
