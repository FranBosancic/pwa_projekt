<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: prijava.php");
    exit();
}
include 'php_util/connect.php';
define('UPLPATH', 'images/');



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/indexcss.css" />
    <link rel="stylesheet" href="styles/all_articlescss.css" />
    <title>Administracija</title>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <div class="container">
            <div class="welcome">
                <h1>Administracija</h1>
                <h1><?php echo date('l, j. F Y.'); ?></h1>
            </div>

            <?php
            $query = "SELECT * FROM story";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                echo '<div class="artikli">';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<a href="uredi.php?id=' . $row['ID'] . '" class="article-link">';
                    echo '<article>';
                    echo '<img src="' . UPLPATH . $row['slika'] . '" alt="' . htmlspecialchars($row['naslov']) . '">';
                    echo '<h3>' . htmlspecialchars($row['naslov']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['sazetak']) . '</p>';
                    echo '</article>';
                    echo '</a>';
                }
                echo '</div>';
            } else {
                echo '<p>Nema članaka za prikaz.</p>';
            }
            ?>

        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
    <?php mysqli_close($conn); ?>
</body>

</html>