<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <form action="" method="POST">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Se connecter</button>
    </form>
    <p>Vous n'avez pas de compte ? 
        <a href="/projet-commerce-nba/public/register">
            <button>S'inscrire</button>
        </a>
    </p>
</body>
</html>
