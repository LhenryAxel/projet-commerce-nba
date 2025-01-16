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
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .container {
            display: flex;
            gap: 20px;
            max-width: 1200px;
            justify-content: center;
            align-items: flex-start;
        }

        .form-container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        .form-container h2 {
            margin-top: 0;
            color: #007BFF;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input,
        form textarea,
        form select,
        form button {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        form button {
            background-color: #007BFF;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }

        #filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
        }

        #filter-form div {
            flex: 1;
            min-width: 120px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table thead {
            background-color: #007BFF;
            color: white;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .back-link:hover {
            background-color: #0056b3;
        }

        a.delete {
            text-decoration: none;
            padding: 6px 12px;
            background-color: #dc3545;
            color: white;
            border-radius: 5px;
            font-weight: bold;
            font-size: 14px;
            display: inline-block;
            margin-right: 5px;
        }

        a.delete:hover {
            background-color: #c82333;
        }

        a.edit {
            text-decoration: none;
            padding: 6px 12px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            font-weight: bold;
            font-size: 14px;
            display: inline-block;
        }

        a.edit:hover {
            background-color: #218838;
        }

        td img {
            max-width: 50px;
            max-height: 50px;
            object-fit: cover;
        }

    </style>
</head>
<body>
    <h1>Gestion des produits</h1>
    <div class="container">
        <!-- Form for adding products -->
        <div class="form-container">
            <h2>Ajouter un produit</h2>
            <form action="/projet-commerce-nba/public/products" method="POST" enctype="multipart/form-data">
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
        
    <label for="image">Image :</label>
    <input type="file" name="image" id="image" accept="image/*">

    <button type="submit">Ajouter</button>
</form>

        </div>

        <!-- Filter form -->
        <div class="form-container">
            <h2>Filtrer les produits</h2>
            <form id="filter-form" method="GET" action="/projet-commerce-nba/public/products">
                <div>
                    <label for="category_filter">Catégorie :</label>
                    <select name="category_filter" id="category_filter">
                        <option value="">Toutes</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= isset($_GET['category_filter']) && $_GET['category_filter'] == $category['id'] ? 'selected' : '' ?>>
                                <?= $category['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="price_min">Prix min :</label>
                    <input type="number" name="price_min" id="price_min" value="<?= $_GET['price_min'] ?? '' ?>" step="0.01">
                </div>

                <div>
                    <label for="price_max">Prix max :</label>
                    <input type="number" name="price_max" id="price_max" value="<?= $_GET['price_max'] ?? '' ?>" step="0.01">
                </div>

                <button type="submit">Filtrer</button>
            </form>
        </div>
    </div>

    <!-- Table for displaying products -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Catégorie</th>
                <th>Image</th>
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
                            <?php if (!empty($product['image_path'])): ?>
                                <img src="/projet-commerce-nba/public/uploads/<?= htmlspecialchars(basename($product['image_path'])) ?>" 
         alt="<?= htmlspecialchars($product['name']) ?>" 
         style="max-width: 50px; max-height: 50px; object-fit: cover;">
                            <?php else: ?>
                                Aucun
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/projet-commerce-nba/public/products/edit?id=<?= $product['id'] ?>" class="edit">Modifier</a>
                            <a href="/projet-commerce-nba/public/products/delete?id=<?= $product['id'] ?>" class="delete" onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Aucun produit trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="/projet-commerce-nba/public/" class="back-link">Retour à l'accueil</a>
</body>
</html>
