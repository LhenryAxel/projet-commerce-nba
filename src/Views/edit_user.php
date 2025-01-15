<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="email"],
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        form button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }

        .back-link {
            display: block;
            text-align: center;
            margin: 20px auto;
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Modifier l'utilisateur</h1>
    <form action="/projet-commerce-nba/public/users/edit?id=<?= $user['id'] ?>" method="POST">
        <label for="first_name">Prénom :</label>
        <input type="text" name="first_name" id="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>

        <label for="last_name">Nom :</label>
        <input type="text" name="last_name" id="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <label for="role">Rôle :</label>
        <select name="role" id="role">
            <option value="client" <?= $user['role'] === 'client' ? 'selected' : '' ?>>Client</option>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Administrateur</option>
        </select>

        <button type="submit">Mettre à jour</button>
    </form>
    <a href="/projet-commerce-nba/public/users" class="back-link">Retour à la liste des utilisateurs</a>
</body>
</html>
