<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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

        a {
            text-decoration: none;
            color: inherit;
        }

        .login-container {
            background-color: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .login-container h1 {
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

        .register-link {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #555;
        }

        .register-link a button {
            background-color: #28a745;
            color: white;
            font-size: 0.9rem;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 0.5rem 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .register-link a button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Connexion</h1>
        <form action="" method="POST">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
            
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required>
            
            <button type="submit">Se connecter</button>
        </form>
        <p class="register-link">Vous n'avez pas de compte ? 
            <a href="/projet-commerce-nba/public/register">
                <button>S'inscrire</button>
            </a>
        </p>
    </div>
</body>
</html>
