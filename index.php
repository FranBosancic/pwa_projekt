<?php
session_start();
include 'php_util/connect.php';
define('UPLPATH', 'images/');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/indexcss.css" />
    <link rel="stylesheet" href="styles/all_articlescss.css" />
    <title>Početna stranica</title>
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <main>
        <div class="container">
            <div class="welcome">
                <h1>Welcome to the site!</h1>
                <h1><?php echo date('l, j. F Y.'); ?></h1>
            </div>

            <?php
            // Dohvati sve kategorije iz tablice kategorija
            $all_categories_query = "SELECT ID, naziv FROM kategorija;";
            $categories_result = mysqli_query($conn, $all_categories_query);


            if ($categories_result && mysqli_num_rows($categories_result) > 0) {
                while ($category_row = mysqli_fetch_assoc($categories_result)) {
                    $kategorija_id = $category_row['ID'];
                    $kategorija_naziv = $category_row['naziv'];

                    echo '<section>';
                    echo '  <div class="naslov ' . htmlspecialchars(strtolower($kategorija_naziv)) . '">';
                    echo '    <h2>' . htmlspecialchars(ucfirst($kategorija_naziv)) . '</h2>';
                    echo '  </div>';
                    echo '  <div class="artikli">';

                    $query2 = "SELECT * FROM story WHERE arhiva = 0 AND kategorija_id = " . (int) $kategorija_id . " ORDER BY id DESC LIMIT 3";
                    $result2 = mysqli_query($conn, $query2);

                    if ($result2 && mysqli_num_rows($result2) > 0) {
                        while ($row = mysqli_fetch_assoc($result2)) {
                            echo '<a href="clanak.php?id=' . $row['ID'] . '" class="article-link">';
                            echo '  <article>';
                            echo '    <img src="' . UPLPATH . $row['slika'] . '" alt="' . htmlspecialchars($row['naslov']) . '">';
                            echo '    <h3>' . htmlspecialchars($row['naslov']) . '</h3>';
                            echo '    <p>' . htmlspecialchars($row['sazetak']) . '</p>';
                            echo '  </article>';
                            echo '</a>';
                        }
                    } else {
                        echo '<p>Nema dostupnih članaka u ovoj kategoriji.</p>';
                    }

                    echo '  </div>';
                    echo '</section>';
                }
            }

            ?>


        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <?php mysqli_close($conn); ?>

<script>
  const hamburgerBtn = document.getElementById('hamburger-btn');
  const navLinks = document.querySelector('.nav-links');

  hamburgerBtn.addEventListener('click', () => {
    navLinks.classList.toggle('active');
  });
</script>

</body>

</html>