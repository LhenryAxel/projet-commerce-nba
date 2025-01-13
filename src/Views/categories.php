<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des catégories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
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
        form textarea {
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

        table th,
        table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table tbody tr:hover {
            background-color: #f9f9f9;
        }

        a {
            text-decoration: none;
            padding: 6px 12px;
            color: white;
            background-color: #28a745;
            border-radius: 5px;
            margin-right: 5px;
            font-size: 14px;
        }

        a:hover {
            background-color: #218838;
        }

        a.delete {
            background-color: #dc3545;
        }

        a.delete:hover {
            background-color: #c82333;
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
    <h1>Gestion des catégories</h1>

    <form action="/projet-commerce-nba/public/categories" method="POST">
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" placeholder="Nom de la catégorie" required>

        <label for="description">Description :</label>
        <textarea name="description" id="description" placeholder="Description"></textarea>

        <button type="submit">Enregistrer</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Nombre de produits</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category['id'] ?></td>
                        <td><?= $category['name'] ?></td>
                        <td><?= $category['description'] ?></td>
                        <td><?= $category['product_count'] ?></td> <!-- Affichage du nombre de produits -->
                        <td>
                            <a href="/projet-commerce-nba/public/categories/delete?id=<?= $category['id'] ?>"
                            class="delete"
                            onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">Supprimer</a>

                            <a href="/projet-commerce-nba/public/categories/edit?id=<?= $category['id'] ?>">Modifier</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Aucune catégorie trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="back-container">
        <a href="/projet-commerce-nba/public/" class="back-link">Retour à l'accueil</a>
    </div>
</body>
</html>
