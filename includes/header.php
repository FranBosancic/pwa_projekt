<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include 'php_util/connect.php';
$query = "SELECT * FROM kategorija;";
$result = mysqli_query($conn, $query);
?>

<header>
  <div class="container">
    <nav>
      <a href="index.php" class="logo-link">
        <img src="logo_folder/bbc_logo.png" alt="BBC logo" width="100px" />
      </a>

      <button class="hamburger" id="hamburger-button" aria-label="Toggle navigation" aria-expanded="false">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </button>

      <ul class="navbar" id="nav-links">
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

<script>
  const hamburgerButton = document.getElementById('hamburger-button');
  const navLinks = document.getElementById('nav-links');

  hamburgerButton.addEventListener('click', () => {
    navLinks.classList.toggle('active');

    hamburgerButton.classList.toggle('active');

    const isExpanded = hamburgerButton.getAttribute('aria-expanded') === 'true';
    hamburgerButton.setAttribute('aria-expanded', !isExpanded);
  });
</script>
</body> 

</html> 