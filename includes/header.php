<?php
include 'php_util/connect.php';
$query = "SELECT * FROM kategorija;";
$result = mysqli_query($conn, $query);
?>

<header>
  <div class="container">
    <nav>
      <ul class="navbar">
        <li class="logo">
          <img src="logo_folder/bbc_logo.png" alt="BBC logo" width="100px" />
        </li>
        <li><a href="index.php">Home</a></li>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $kategorija = strtolower(htmlspecialchars($row['naziv']));
            $ispisKategorije = ucfirst($kategorija);
            echo "<li><a href=\"kategorija.php?kategorija=$kategorija\">$ispisKategorije</a></li>";
          }
        }
        ?>
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
          <li><a href="administracija.php">Administracija</a></li>
          <li><a href="unos.php">Unos</a></li>
          <li><a href="php_util/logout.php">Logout</a></li>
        <?php else: ?>
          <li><a href="prijava.php">Prijava</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</header>