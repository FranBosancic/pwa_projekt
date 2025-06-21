<?php
session_start();
include 'connect.php';

$id = (int)$_POST['id'];

if (isset($_POST['delete'])) {
    $stmt = $conn->prepare("DELETE FROM story WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Članak obrisan.'); window.location.href = '../administracija.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $naslov = trim($_POST['naslov']);
    $sazetak = trim($_POST['sazetak']);
    $tekst = trim($_POST['tekst']);
    $kategorija = (int)$_POST['kategorija'];
    $arhiva = isset($_POST['arhiva']) ? 1 : 0;

    // Slika
    if (!empty($_FILES['slika']['name'])) {
        $slika = $_FILES['slika']['name'];
        $target = '../images/' . basename($slika);
        move_uploaded_file($_FILES['slika']['tmp_name'], $target);
    } else {
        $res = $conn->prepare("SELECT slika FROM story WHERE ID = ?");
        $res->bind_param("i", $id);
        $res->execute();
        $res->bind_result($slika);
        $res->fetch();
        $res->close();
    }

    $stmt = $conn->prepare("UPDATE story SET naslov=?, sazetak=?, tekst=?, kategorija_id=?, slika=?, arhiva=? WHERE ID=?");
    $stmt->bind_param("sssisii", $naslov, $sazetak, $tekst, $kategorija, $slika, $arhiva, $id);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Promjene spremljene.'); window.location.href = '../administracija.php';</script>";
    exit;
}

$conn->close();
?>
