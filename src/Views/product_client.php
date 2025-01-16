<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits disponibles</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            box-sizing: border-box;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        header nav {
            display: flex;
            gap: 10px;
        }

        header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 15px;
            background-color: #dc3545;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        header a:hover {
            background-color: #c82333;
        }

        main {
            padding: 20px;
            box-sizing: border-box;
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

        table img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Produits disponibles</h1>
        <nav>
            <a href="/projet-commerce-nba/public/nba_articles">Voir les articles</a>
            <a href="/projet-commerce-nba/public/logout">Déconnexion</a>
        </nav>
    </header>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['id']) ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['description']) ?></td>
                        <td><?= htmlspecialchars($product['price']) ?>€</td>
                        <td>
                            <?php if (!empty($product['image_path'])): ?>
                                <img src="/projet-commerce-nba/public<?= htmlspecialchars($product['image_path']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                            <?php else: ?>
                                Pas d'image
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Aucun produit disponible.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
