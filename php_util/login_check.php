<?php
session_start();
include 'connect.php'; // konekcija na bazu

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Sigurna priprema upita - izbjegava SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Provjera lozinke
        if (password_verify($password, $user['password'])) {
            // uspješna prijava
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['logged_in'] = true;

            header("Location: ../index.php");
            exit();
        } else {
            // pogrešna lozinka
            $_SESSION['login_error'] = "Neispravno korisničko ime ili lozinka.";
            header("Location: ../prijava.php");
            exit();
        }
    } else {
        // korisnik ne postoji
        $_SESSION['login_error'] = "Neispravno korisničko ime ili lozinka.";
        header("Location: ../prijava.php");
        exit();
    }
} else {
    // ako netko pristupi direktno, redirect na login
    header("Location: ../prijava.php");
    exit();
}
?>
