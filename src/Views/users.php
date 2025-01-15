<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }

        h1 {
            text-align: center;
            color: #222;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table thead {
            background-color: #007BFF;
            color: white;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .action-buttons a {
            text-decoration: none;
            padding: 6px 12px;
            color: white;
            border-radius: 5px;
            font-size: 14px;
        }

        .action-buttons a.edit {
            background-color: #28a745;
        }

        .action-buttons a.delete {
            background-color: #dc3545;
        }

        .action-buttons a:hover {
            opacity: 0.9;
        }

        .add-user-form {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            max-width: 600px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .add-user-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .add-user-form input, .add-user-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .add-user-form button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .add-user-form button:hover {
            background-color: #0056b3;
        }

        .back-link {
            display: block;
            margin: 20px auto;
            text-align: center;
            font-size: 16px;
            text-decoration: none;
            color:rgb(255, 255, 255);
            padding: 10px 20px;
            background-color: #007BFF;
            border-radius: 5px;
            font-weight: bold;
            width: 150px;
            margin-top: 30px;
        }

        .back-link:hover {
            background-color: #0056b3;
        }

        .back-container {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <h1>Gestion des utilisateurs</h1>

    <!-- Formulaire d'ajout d'utilisateur -->
    <div class="add-user-form">
        <h2>Ajouter un utilisateur</h2>
        <form action="/projet-commerce-nba/public/users/create" method="POST">
            <label for="first_name">Prénom :</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Nom :</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Rôle :</label>
            <select id="role" name="role" required>
                <option value="client">Client</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Ajouter</button>
        </form>
    </div>

    <!-- Tableau des utilisateurs -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['first_name'] ?></td>
                        <td><?= $user['last_name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= ucfirst($user['role']) ?></td>
                        <td class="action-buttons">
                            <a href="/projet-commerce-nba/public/users/edit?id=<?= $user['id'] ?>" class="edit">Modifier</a>
                            <a href="/projet-commerce-nba/public/users/delete?id=<?= $user['id'] ?>" class="delete" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Aucun utilisateur trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="back-container">
        <a href="/projet-commerce-nba/public/" class="back-link">Retour à l'accueil</a>
    </div>
</body>
</html>
