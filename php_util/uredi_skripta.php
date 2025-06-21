<?php
session_start();
include 'connect.php';

$id = (int)$_POST['id'];

if (isset($_POST['delete'])) {
    $query = "DELETE FROM story WHERE ID = $id";
    mysqli_query($conn, $query);
    echo "<script>alert('Članak obrisan.'); window.location.href = '../administracija.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $naslov = $_POST['naslov'];
    $sazetak = $_POST['sazetak'];
    $tekst = $_POST['tekst'];
    $kategorija = $_POST['kategorija'];
    $arhiva = isset($_POST['arhiva']) ? 1 : 0;

    if (!empty($_FILES['slika']['name'])) {
        $slika = $_FILES['slika']['name'];
        $target = '../images/' . basename($slika);
        move_uploaded_file($_FILES['slika']['tmp_name'], $target);
    } else {
        // Ako nije postavljena nova slika, zadrži staru
        $res = mysqli_query($conn, "SELECT slika FROM story WHERE ID = $id");
        $row = mysqli_fetch_assoc($res);
        $slika = $row['slika'];
    }

    $query = "UPDATE story SET naslov='$naslov', sazetak='$sazetak', tekst='$tekst', kategorija='$kategorija', slika='$slika', arhiva='$arhiva' WHERE ID=$id";
    mysqli_query($conn, $query);
    echo "<script>alert('Promjene spremljene.'); window.location.href = '../administracija.php';</script>";
    exit;
}

mysqli_close($conn);
?>
