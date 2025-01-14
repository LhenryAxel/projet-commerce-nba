<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une commande</title>
</head>
<body>
    <h1>Créer une commande</h1>
    <form action="/projet-commerce-nba/public/orders/create" method="POST">
        <label for="customer_name">Nom du client :</label>
        <input type="text" name="customer_name" id="customer_name" required>

        <label for="order_date">Date de commande :</label>
        <input type="date" name="order_date" id="order_date" required>

        <h3>Produits :</h3>
        <?php foreach ($products as $product): ?>
            <div>
                <label>
                    <input type="checkbox" name="products[<?= $product['id'] ?>][selected]" value="1">
                    <?= $product['name'] ?> (Prix: <?= $product['price'] ?> €)
                </label>
                <label for="quantity_<?= $product['id'] ?>">Quantité :</label>
                <input type="number" name="products[<?= $product['id'] ?>][quantity]" id="quantity_<?= $product['id'] ?>" min="1" step="1">
            </div>
        <?php endforeach; ?>

        <button type="submit">Créer la commande</button>
    </form>
    <a href="/projet-commerce-nba/public/orders">Annuler</a>
</body>
</html>
