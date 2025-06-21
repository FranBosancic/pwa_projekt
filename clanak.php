<?php
session_start();
include 'php_util/connect.php';
define('UPLPATH', 'images/');

// Provjera je li ID postavljen i valjan broj
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Neispravan ID članka.</p>";
    exit;
}

$id = (int) $_GET['id'];

// Upit s JOIN-om za dohvat članka i naziva kategorije
$query = "SELECT story.*, kategorija.naziv AS kategorija_naziv 
          FROM story 
          JOIN kategorija ON story.kategorija_id = kategorija.id 
          WHERE story.id = $id AND story.arhiva = 0";

$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "<p>Članak nije pronađen ili je arhiviran.</p>";
    exit;
}

$rezultat = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($rezultat['naslov']); ?></title>
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/clanakcss.css" />
</head>

<body>

    <?php include 'includes/header.php'; ?>
    <section class="pozadinska_boja_naslova <?php echo htmlspecialchars(strtolower($rezultat['kategorija_naziv'])); ?>">
        <div class="naslov">
            <h1><?php echo htmlspecialchars(strtoupper($rezultat['kategorija_naziv'])); ?></h1>
        </div>
    </section>
    <main>
        <div class="container">
            <article>
                <h1><?php echo htmlspecialchars($rezultat['naslov']); ?></h1>
                <img src="<?php echo UPLPATH . htmlspecialchars($rezultat['slika']); ?>"
                    alt="<?php echo htmlspecialchars($rezultat['naslov']); ?>">
                <h2><?php echo htmlspecialchars($rezultat['sazetak']); ?></h2>
                <div class="tekst">
                    <?php
                    $tekst = str_replace('\r\n', "\n", $rezultat['tekst']);
                    echo nl2br(htmlspecialchars($tekst));
                    ?>
                </div>

                <a href="index.php" class="back-link">← Povratak na naslovnicu</a>
            </article>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <?php mysqli_close($conn); ?>
</body>

</html>