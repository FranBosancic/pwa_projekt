<?php
session_start();
include 'php_util/connect.php'; // Uključi konekciju na bazu

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: prijava.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/style.css" />
  <link rel="stylesheet" href="styles/forma.css" />
  <title>Unos Vijesti</title>

  <script>
    function confirmSubmit() {
      return confirm('Jesi li siguran da želiš poslati vijest?');
    }

    function confirmReset() {
      return confirm('Jesi li siguran da želiš očistiti formu?');
    }
  </script>

</head>

<body>

  <?php include 'includes/header.php'; ?>

  <main>
    <div class="container">
      <div class="welcome">
        <h1>Unos nove vijesti</h1>
      </div>

      <section>
        <form action="php_util/skripta.php" method="POST" enctype="multipart/form-data" class="forma"
          onsubmit="return confirmSubmit()">

          <label for="naslov">Naslov vijesti:</label>
          <input type="text" id="naslov" name="naslov" required />

          <label for="sazetak">Kratki sažetak:</label>
          <textarea id="sazetak" name="sazetak" rows="3" required></textarea>

          <label for="tekst">Tekst vijesti:</label>
          <textarea id="tekst" name="tekst" rows="6" required></textarea>

          <label for="kategorija">Kategorija vijesti:</label>
          <select id="kategorija" name="kategorija" required>
            <option value="">Odaberite kategoriju</option>
            <?php
            $query = "SELECT id, naziv FROM kategorija";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $naziv = ucfirst(htmlspecialchars($row['naziv']));
                echo "<option value=\"$id\">$naziv</option>";
              }
            }
            ?>
          </select>

          <label for="slika">Odaberite sliku:</label>
          <input type="file" id="slika" name="slika" accept="image/*" />

          <label>
            <input type="checkbox" name="prikazi" value="1" />
            Arhiva
          </label>
          <button type="reset" class="resetGumb" onclick="return confirmReset()">Osvježi formu</button>
          <button type="submit">Pošalji vijest</button>

        </form>
      </section>
    </div>
  </main>

  <?php include 'includes/footer.php'; ?>

</body>

</html>