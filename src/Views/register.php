<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <form action="/projet-commerce-nba/public/register" method="POST">
        <label for="first_name">Prénom :</label>
        <input type="text" name="first_name" id="first_name" required>

        <label for="last_name">Nom :</label>
        <input type="text" name="last_name" id="last_name" required>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
