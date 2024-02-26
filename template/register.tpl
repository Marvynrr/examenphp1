<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="register-container">
        <form action="?route=register" method="POST">
            <h2>Inscription</h2>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">Confirmer mot de passe:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>

            <button name="submit" type="submit">Inscription</button>
            <a href="?route=login" class="button">Se connecter</a>
        </form>
    </div>
</body>
</html>