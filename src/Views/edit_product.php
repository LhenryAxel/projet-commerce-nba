<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit</title>
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

        a {
            display: block;
            max-width: 200px;
            margin: 20px auto;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            color: white;
            background-color: #6c757d;
            border-radius: 5px;
        }

        a:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <h1>Modifier un produit</h1>
    <form action="/projet-commerce-nba/public/products/edit" method="POST">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" value="<?= $product['name'] ?>" required>

        <label for="description">Description :</label>
        <textarea name="description" id="description" required><?= $product['description'] ?></textarea>

        <label for="price">Prix :</label>
        <input type="number" name="price" id="price" step="0.01" value="<?= $product['price'] ?>" required>

        <label for="stock">Stock :</label>
        <input type="number" name="stock" id="stock" value="<?= $product['stock'] ?>" required>

        <label for="category_id">Catégorie :</label>
        <select name="category_id" id="category_id" required>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>>
                        <?= $category['name'] ?>
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">Aucune catégorie disponible</option>
            <?php endif; ?>
        </select>

        <button type="submit">Mettre à jour</button>
    </form>
    <a href="/projet-commerce-nba/public/products">Annuler</a>
</body>
</html>
