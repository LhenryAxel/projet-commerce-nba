<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            text-align: center;
            color: #222;
        }

        .register-container {
            background-color: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .register-container h1 {
            margin-bottom: 1.5rem;
            color: #006bb6;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        form label {
            text-align: left;
            font-weight: bold;
            color: #333;
        }

        form input {
            padding: 0.8rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form button {
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

        form button:hover {
            background-color: #00509e;
        }

        .login-link {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #555;
        }

        .login-link a {
            color: #006bb6;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #003f7f;
        }
    </style>
</head>
<body>
    <div class="register-container">
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
        <p class="login-link">Déjà inscrit ? 
            <a href="/projet-commerce-nba/public/login">Connectez-vous ici</a>.
        </p>
    </div>
</body>
</html>
