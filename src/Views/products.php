<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des produits</title>
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
        form input[type="number"],
        form textarea,
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
            color: white;
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
    <h1>Gestion des produits</h1>

    <!-- Formulaire pour ajouter un produit -->
    <form action="/projet-commerce-nba/public/products" method="POST">
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" placeholder="Nom du produit" required>

        <label for="description">Description :</label>
        <textarea name="description" id="description" placeholder="Description"></textarea>

        <label for="price">Prix :</label>
        <input type="number" name="price" id="price" step="0.01" placeholder="Prix du produit" required>

        <label for="stock">Stock :</label>
        <input type="number" name="stock" id="stock" placeholder="Quantité en stock" required>

        <label for="category_id">Catégorie :</label>
        <select name="category_id" id="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Ajouter le produit</button>
    </form>

        <!-- Filtre pour les produits -->
        <form method="GET" action="/projet-commerce-nba/public/products">
        <label for="category_filter">Filtrer par catégorie :</label>
        <select name="category_filter" id="category_filter">
            <option value="">Toutes les catégories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>" <?= isset($_GET['category_filter']) && $_GET['category_filter'] == $category['id'] ? 'selected' : '' ?>>
                    <?= $category['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="price_min">Prix minimum :</label>
        <input type="number" name="price_min" id="price_min" value="<?= $_GET['price_min'] ?? '' ?>" step="0.01">

        <label for="price_max">Prix maximum :</label>
        <input type="number" name="price_max" id="price_max" value="<?= $_GET['price_max'] ?? '' ?>" step="0.01">

        <button type="submit">Filtrer</button>
    </form>

    <!-- Tableau des produits -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['description'] ?></td>
                        <td><?= $product['price'] ?>€</td>
                        <td><?= $product['stock'] ?></td>
                        <td><?= $product['category_name'] ?></td>
                        <td>
                            <a href="/projet-commerce-nba/public/products/edit?id=<?= $product['id'] ?>">Modifier</a>
                            <a href="/projet-commerce-nba/public/products/delete?id=<?= $product['id'] ?>" 
                               class="delete"
                               onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Aucun produit trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="back-container">
        <a href="/projet-commerce-nba/public/" class="back-link">Retour à l'accueil</a>
    </div>
</body>
</html>
