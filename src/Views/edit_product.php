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

        .image-preview {
            display: block;
            margin: 20px auto;
            text-align: center;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 200px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Modifier un produit</h1>
    <form action="/projet-commerce-nba/public/products/edit" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">

    <label for="name">Nom :</label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($product['name']) ?>" required>

    <label for="description">Description :</label>
    <textarea name="description" id="description" required><?= htmlspecialchars($product['description']) ?></textarea>

    <label for="price">Prix :</label>
    <input type="number" name="price" id="price" step="0.01" value="<?= $product['price'] ?>" required>

    <label for="stock">Stock :</label>
    <input type="number" name="stock" id="stock" value="<?= $product['stock'] ?>" required>

    <label for="category_id">Catégorie :</label>
    <select name="category_id" id="category_id" required>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id'] ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($category['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="image">Image :</label>
    <input type="file" name="image" id="image">

    <?php if (!empty($product['image_path'])): ?>
        <div class="image-preview">
            <img src="/projet-commerce-nba/public/uploads/<?= htmlspecialchars(basename($product['image_path'])) ?>" 
                 alt="<?= htmlspecialchars($product['name']) ?>" 
                 style="max-width: 200px; max-height: 200px; object-fit: cover;">
            <label>
                <input type="checkbox" name="delete_image" value="1">
                Supprimer l'image actuelle
            </label>
        </div>
    <?php endif; ?>

    <button type="submit">Mettre à jour</button>
</form>
<a href="/projet-commerce-nba/public/products" class="back-link">Annuler</a>
</body>
</html>
