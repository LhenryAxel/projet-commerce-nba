<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des produits</title>
</head>
<body>
    <h1>Gestion des produits</h1>

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

    <a href="/projet-commerce-nba/public/">Retour à l'accueil</a>
</body>
</html>
