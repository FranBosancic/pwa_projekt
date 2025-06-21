<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/registracijacss.css" />
    <title>Registracija</title>
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <main class="registration-page">
        <div class="registration-container">
            <form action="php_util/registration.php" method="POST" class="registration-form">
                <h2>Registracija</h2>

                <label for="username">Korisničko ime</label>
                <input type="text" name="username" id="username" required>

                <label for="password">Lozinka</label>
                <input type="password" name="password" id="password" required>

                <label for="confirm_password">Potvrdi lozinku</label>
                <input type="password" name="confirm_password" id="confirm_password" required>

                <button type="submit">Registriraj se</button>

                <?php
                if (isset($_SESSION['registration_error'])) {
                    echo '<p class="error">' . htmlspecialchars($_SESSION['registration_error']) . '</p>';
                    unset($_SESSION['registration_error']);
                }
                if (isset($_SESSION['registration_success'])) {
                    echo '<p class="success">' . htmlspecialchars($_SESSION['registration_success']) . '</p>';
                    unset($_SESSION['registration_success']);
                }
                ?>
            </form>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>
