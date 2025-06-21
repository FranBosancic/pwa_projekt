<?php
session_start();
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Provjera praznih polja
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $_SESSION['registration_error'] = "Sva polja su obavezna.";
        header("Location: ../registracija.php");
        exit();
    }

    // Provjera lozinki
    if ($password !== $confirm_password) {
        $_SESSION['registration_error'] = "Lozinke se ne podudaraju.";
        header("Location: ../registracija.php");
        exit();
    }

    // Provjera postoji li korisnik
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['registration_error'] = "Korisničko ime je već zauzeto.";
        $stmt->close();
        header("Location: ../registracija.php");
        exit();
    }
    $stmt->close();

    // Hash lozinke i spremanje u bazu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['logged_in'] = true;
        //Redirect na index -> automatski login
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['registration_error'] = "Greška prilikom registracije. Pokušajte ponovno.";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../registracija.php");
    exit();
} else {
    header("Location: ../registracija.php");
    exit();
}
