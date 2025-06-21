<?php
session_start();
include 'connect.php';

// Preuzimanje i sanitizacija unosa
$naslov = mysqli_real_escape_string($conn, $_POST['naslov']);
$sazetak = mysqli_real_escape_string($conn, $_POST['sazetak']);
$tekst = mysqli_real_escape_string($conn, $_POST['tekst']);
$kategorija_id = (int) $_POST['kategorija']; // sigurnije jer mora biti broj
$arhiva = isset($_POST['prikazi']) ? 1 : 0;

// Rad sa slikom
$slika = $_FILES['slika']['name'];
$target_dir = '../images/' . basename($slika);

if (!empty($slika)) {
    move_uploaded_file($_FILES["slika"]["tmp_name"], $target_dir);
}

// Priprema i izvršavanje upita
$query = "INSERT INTO story (naslov, sazetak, tekst, kategorija_id, slika, arhiva)
          VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sssisi", $naslov, $sazetak, $tekst, $kategorija_id, $slika, $arhiva);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Vijest uspješno spremljena!'); window.location.href = '../unos.php';</script>";
} else {
    echo "<script>alert('Došlo je do greške pri spremanju.'); window.history.back();</script>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>