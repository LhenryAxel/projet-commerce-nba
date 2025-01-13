<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit</title>
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
