<?php
session_start();
include 'php_util/connect.php';
define('UPLPATH', 'images/');

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

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
                    <input id="naslov" type="text" name="naslov"
                        value="<?php echo htmlspecialchars($izmjena['naslov']); ?>" required>

                    <label for="sazetak">Sažetak:</label>
                    <textarea id="sazetak" name="sazetak" rows="3"
                        required><?php echo htmlspecialchars($izmjena['sazetak']); ?></textarea>

                    <label for="tekst">Tekst:</label>
                    <textarea id="tekst" name="tekst" rows="6"
                        required><?php echo htmlspecialchars(str_replace('\r\n', "\n", $izmjena['tekst'])); ?></textarea>


                    <label for="kategorija">Kategorija:</label>
                    <select id="kategorija" name="kategorija" required>
                        <option value="">Odaberite kategoriju</option>
                        <?php
                        $query = "SELECT id, naziv FROM kategorija";
                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $naziv = ucfirst(htmlspecialchars($row['naziv']));
                                // Provjera je li je ovo kategorija iz članka
                                $selected = ($id == $izmjena['kategorija_id']) ? 'selected' : '';
                                echo "<option value=\"$id\" $selected>$naziv</option>";
                            }
                        }
                        ?>
                    </select>


                    <label for="slika">Slika:</label>
                    <input type="file" name="slika">
                    <div class="trenutna_slika">
                        <p>Trenutna slika: </p><img src="images/<?php echo $izmjena['slika']; ?>" width="100px">
                    </div>

                    <label>
                        <input type="checkbox" name="arhiva" <?php if ($izmjena['arhiva'] == 1)
                            echo 'checked'; ?>>
                        Arhiviraj
                    </label>

                    <input type="hidden" name="id" value="<?php echo $izmjena['ID']; ?>">

                    <button type="submit" name="update">Spremi promjene</button>
                    <button type="submit" name="delete" onclick="return confirmDelete()"
                        style="background-color: red;">Izbriši članak</button>
                </form>

                <script>
                    document.querySelector('.forma').addEventListener('submit', function (e) {
                        const naslov = document.getElementById('naslov').value.trim();
                        const sazetak = document.getElementById('sazetak').value.trim();
                        const tekst = document.getElementById('tekst').value.trim();

                        const errors = [];

                        if (naslov.length < 5 || naslov.length > 32) {
                            errors.push("Naslov mora imati između 5 i 32 znaka.");
                        }
                        if (sazetak.length < 20 || sazetak.length > 255) {
                            errors.push("Sažetak mora imati između 20 i 255 znakova.");
                        }
                        if (tekst.length < 50) {
                            errors.push("Tekst mora imati najmanje 50 znakova.");
                        }

                        if (errors.length > 0) {
                            e.preventDefault(); // spriječi slanje forme
                            alert(errors.join("\n"));
                        } else {
                            if (!confirm("Jesi li siguran da želiš poslati vijest?")) {
                                e.preventDefault();
                            }
                        }
                    });
                </script>



            </section>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>