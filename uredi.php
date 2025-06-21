<?php
session_start();
include 'php_util/connect.php';
define('UPLPATH', 'images/');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Dohvati članak po ID-u
$query = "SELECT * FROM story WHERE ID = $id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<p>Članak nije pronađen.</p>";
    exit;
}

$izmjena = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/forma.css" />
    <link rel="stylesheet" href="styles/uredicss.css" />
    <title>Uredi članak</title>

    <script>
    function confirmPromjena() {
      return confirm('Jesi li siguran da želiš promijeniti vijest?');
    }

    function confirmDelete() {
      return confirm('Jesi li siguran da želiš izbrisati članak?');
    }
  </script>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <div class="container">
            <div class="welcome">
                <h1>Uredi članak</h1>
            </div>

            <section>
                <form action="php_util/uredi_skripta.php" method="POST" enctype="multipart/form-data" class="forma">
                    <label for="naslov">Naslov:</label>
                    <input type="text" name="naslov" value="<?php echo htmlspecialchars($izmjena['naslov']); ?>" required>

                    <label for="sazetak">Sažetak:</label>
                    <textarea name="sazetak" rows="3" required><?php echo htmlspecialchars($izmjena['sazetak']); ?></textarea>

                    <label for="tekst">Tekst:</label>
                    <textarea name="tekst" rows="6" required><?php echo htmlspecialchars($izmjena['tekst']); ?></textarea>

                    <label for="kategorija">Kategorija:</label>
                    <select name="kategorija" required>
                        <option value="news" <?php if ($izmjena['kategorija'] == 'news') echo 'selected'; ?>>News</option>
                        <option value="sport" <?php if ($izmjena['kategorija'] == 'sport') echo 'selected'; ?>>Sport</option>
                        <option value="politics" <?php if ($izmjena['kategorija'] == 'politics') echo 'selected'; ?>>Politics</option>
                    </select>

                    <label for="slika">Slika:</label>
                    <input type="file" name="slika">
                    <div class="trenutna_slika">
                        <p>Trenutna slika: </p><img src="images/<?php echo $izmjena['slika']; ?>" width="100px">
                    </div>

                    <label>
                        <input type="checkbox" name="arhiva" <?php if ($izmjena['arhiva'] == 1) echo 'checked'; ?>>
                        Arhiviraj
                    </label>

                    <input type="hidden" name="id" value="<?php echo $izmjena['ID']; ?>">

                    <button type="submit" name="update" onclick="return confirmPromjena()">Spremi promjene</button>
                    <button type="submit" name="delete" onclick="return confirmDelete()" style="background-color: red;">Izbriši članak</button>
                </form>
            </section>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>