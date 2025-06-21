<?php
session_start();
include 'php_util/connect.php';
define('UPLPATH', 'images/');

// Provjera je li parametar kategorija postavljen u URL-u
if (!isset($_GET['kategorija'])) {
    echo "<p>Kategorija nije definirana.</p>";
    exit;
}

// Sigurno dohvaćanje parametra i sanitizacija
$kategorija_sve = mysqli_real_escape_string($conn, $_GET['kategorija']);
$ispisKategorije = ucfirst($kategorija_sve);
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo htmlspecialchars($ispisKategorije); ?></title>
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/kategorijacss.css" />
    <link rel="stylesheet" href="styles/all_articlescss.css" />
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <section class="pozadinska_boja_naslova <?php echo htmlspecialchars(strtolower($kategorija_sve)); ?>">
        <div class="naslov">
            <h1><?php echo htmlspecialchars(strtoupper($ispisKategorije)); ?></h1>
        </div>
    </section>

    <main>
        <div class="container">
            <div class="artikli">
                <?php
                // SQL upit s JOIN-om da dohvatimo samo one članke koji imaju zadanu kategoriju
                $query = "
                    SELECT story.* 
                    FROM story 
                    JOIN kategorija ON story.kategorija_id = kategorija.id 
                    WHERE story.arhiva = 0 AND kategorija.naziv = '$kategorija_sve'
                    ORDER BY story.ID DESC
                ";
                $result = mysqli_query($conn, $query);

                if (!$result) {
                    echo "<p>Greška u upitu: " . mysqli_error($conn) . "</p>";
                } elseif (mysqli_num_rows($result) === 0) {
                    echo "<p>Nema dostupnih članaka u ovoj kategoriji.</p>";
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<a href="clanak.php?id=' . $row['ID'] . '" class="article-link">';
                        echo '<article>';
                        echo '<img src="' . UPLPATH . htmlspecialchars($row['slika']) . '" alt="' . htmlspecialchars($row['naslov']) . '">';
                        echo '<h3>' . htmlspecialchars($row['naslov']) . '</h3>';
                        echo '<p>' . htmlspecialchars($row['sazetak']) . '</p>';
                        echo '</article>';
                        echo '</a>';
                    }
                }

                mysqli_close($conn);
                ?>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>
