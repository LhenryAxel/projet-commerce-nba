<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des commandes</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        .form-status {
            display: inline;
        }

        .form-status select {
            padding: 5px;
        }

        .form-status button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .form-status button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Gestion des commandes</h1>
    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Total</th>
            <th>Statut</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $order['user_name'] ?></td>
                    <td><?= number_format($order['total'], 2) ?>€</td>
                    <td>
                        <!-- Form to update order status -->
                        <form action="/projet-commerce-nba/public/orders/edit" method="POST" class="form-status">
                            <input type="hidden" name="id" value="<?= $order['id'] ?>">
                            <select name="status" required>
                                <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="processing" <?= $order['status'] === 'processing' ? 'selected' : '' ?>>Processing</option>
                                <option value="completed" <?= $order['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                                <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                            </select>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                    <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                    <td>
                        <a href="/projet-commerce-nba/public/orders/view?id=<?= $order['id'] ?>">View Details</a>
                        <a href="/projet-commerce-nba/public/orders/delete?id=<?= $order['id'] ?>" 
                           onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No orders found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

    
    <h2>Créer une commande</h2>
<form method="POST" action="/projet-commerce-nba/public/orders">
    <label for="user_id">Utilisateur :</label>
    <select name="user_id" id="user_id" required>
        <?php foreach ($users as $user): ?>
            <option value="<?= $user['id'] ?>"><?= $user['first_name'] . ' ' . $user['last_name'] ?></option>
        <?php endforeach; ?>
    </select>

    <label for="products">Produits :</label>
    <div id="products">
        <?php foreach ($products as $product): ?>
            <label>
                <input type="checkbox" name="products[<?= $product['id'] ?>][selected]" value="1">
                <?= $product['name'] ?> (<?= $product['price'] ?>€)
            </label>
            <input type="number" name="products[<?= $product['id'] ?>][quantity]" placeholder="Quantité" min="1">
        <?php endforeach; ?>
    </div>

    <button type="submit" name="action" value="create_order">Créer la commande</button>
</form>


    <h2>Calculer les ventes</h2>
<form method="GET" action="/projet-commerce-nba/public/orders">
    <label for="user_id">Utilisateur :</label>
    <select name="user_id" id="user_id">
        <option value="">Tous</option>
        <?php foreach ($users as $user): ?>
            <option value="<?= $user['id'] ?>"><?= $user['first_name'] . ' ' . $user['last_name'] ?></option>
        <?php endforeach; ?>
    </select>

    <label for="start_date">Date de début :</label>
    <input type="date" name="start_date" id="start_date" value="<?= $_GET['start_date'] ?? '' ?>">

    <label for="end_date">Date de fin :</label>
    <input type="date" name="end_date" id="end_date" value="<?= $_GET['end_date'] ?? '' ?>">

    <button type="submit" name="action" value="calculate_sales">Calculer</button>
</form>

<?php if (isset($sales)): ?>
    <p><strong>Total des ventes :</strong> <?= $sales ?>€</p>
<?php endif; ?>

</body>
</html>
