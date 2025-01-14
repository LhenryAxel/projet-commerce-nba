<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la commande</title>
</head>
<body>
    <h1>Détails de la commande #<?= $order['id'] ?></h1>
    <p><strong>Client:</strong> <?= $order['user_name'] ?></p>
    <p><strong>Total:</strong> <?= $order['total'] ?>€</p>
    <p><strong>Statut:</strong> <?= $order['status'] ?></p>
    <p><strong>Date:</strong> <?= $order['created_at'] ?></p>

    <h2>Produits</h2>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orderDetails)): ?>
                <?php foreach ($orderDetails as $detail): ?>
                    <tr>
                        <td><?= $detail['product_name'] ?></td>
                        <td><?= $detail['quantity'] ?></td>
                        <td><?= $detail['price'] ?>€</td>
                        <td><?= $detail['quantity'] * $detail['price'] ?>€</td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Aucun produit dans cette commande.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="/projet-commerce-nba/public/orders">Retour à la liste des commandes</a>
</body>
</html>
