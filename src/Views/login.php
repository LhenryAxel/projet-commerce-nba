<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        /* Styles généraux */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #006bb6;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input {
            padding: 0.8rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            padding: 0.8rem;
            font-size: 1rem;
            font-weight: bold;
            background-color: #006bb6;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #00509e;
        }

        .error-message {
            color: red;
            font-size: 0.9rem;
            text-align: center;
            margin-top: -10px;
        }

        .register-link {
            text-align: center;
            margin-top: 1rem;
        }

        .register-link a {
            color: #006bb6;
            font-weight: bold;
            text-decoration: none;
        }

        .register-link a:hover {
            color: #003f7f;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Connexion</h1>
        <!-- Affichage du message d'erreur -->
        <?php if (!empty($errorMessage)): ?>
            <p class="error-message"><?= htmlspecialchars($errorMessage) ?></p>
        <?php endif; ?>
        <form action="/projet-commerce-nba/public/login" method="POST">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Se connecter</button>
        </form>
        <p class="register-link">Vous n'avez pas de compte ? 
            <a href="/projet-commerce-nba/public/register">S'inscrire</a>
        </p>
    </div>
</body>
</html>
