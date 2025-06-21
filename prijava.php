<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/prijavacss.css" />
    <title>Prijava</title>
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <main class="login-page">
        <div class="login-container">
            <form action="php_util/login_check.php" method="POST" class="login-form">
                <h2>Login</h2>

                <label for="username">Korisničko ime</label>
                <input type="text" name="username" id="username" required>

                <label for="password">Lozinka</label>
                <input type="password" name="password" id="password" required>



                <button type="submit">Prijavi se</button>
                <?php
                if (isset($_SESSION['login_error'])) {
                    echo '<p class="error">' . htmlspecialchars($_SESSION['login_error']) . '</p>';
                    unset($_SESSION['login_error']);
                }
                ?>
                <p class="switch-form">
                    Nemate račun? <a href="registracija.php">Registrirajte se ovdje</a>.
                </p>

            </form>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>