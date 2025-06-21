<?php
session_start();
include 'connect.php';

// Preuzimanje i sanitizacija unosa
$naslov = trim($_POST['naslov']);
$sazetak = trim($_POST['sazetak']);
$tekst = trim($_POST['tekst']);
$kategorija_id = (int) $_POST['kategorija'];
$arhiva = isset($_POST['prikazi']) ? 1 : 0;

$naslov_min = 5;
$naslov_max = 32; 
$sazetak_min = 20;
$sazetak_max = 255; 
$tekst_min = 50;

$errors = [];

if (strlen($naslov) < $naslov_min || strlen($naslov) > $naslov_max) {
    $errors[] = "Naslov mora imati između $naslov_min i $naslov_max znakova.";
}

if (strlen($sazetak) < $sazetak_min || strlen($sazetak) > $sazetak_max) {
    $errors[] = "Sažetak mora imati između $sazetak_min i $sazetak_max znakova.";
}

if (strlen($tekst) < $tekst_min) {
    $errors[] = "Tekst vijesti mora imati najmanje $tekst_min znakova.";
}

// Ako ima grešaka, prikaži ih i prekini skriptu
if (!empty($errors)) {
    $poruke = implode("\\n", $errors);
    echo "<script>alert('$poruke'); window.history.back();</script>";
    exit();
}

// Sanitiziraj za bazu (mysqli_real_escape_string se koristi u bind_param, ali možeš i ovdje)
$naslov = mysqli_real_escape_string($conn, $naslov);
$sazetak = mysqli_real_escape_string($conn, $sazetak);
$tekst = mysqli_real_escape_string($conn, $tekst);

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
