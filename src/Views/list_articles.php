<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des articles</title>
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

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .buttons a {
            text-decoration: none;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            color: white;
        }

        .create-btn {
            background-color: #007BFF;
        }

        .create-btn:hover {
            background-color: #0056b3;
        }

        .back-btn {
            background-color: #6c757d;
        }

        .back-btn:hover {
            background-color: #5a6268;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .article-content {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }

        .article-meta {
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des articles</h1>
        <div class="buttons">
            <a href="/projet-commerce-nba/public" class="back-btn">Retour à l'accueil</a>
            <a href="/projet-commerce-nba/public/nba_articles/create" class="create-btn">Créer un nouvel article</a>
        </div>
        <ul>
            <?php foreach ($articles as $article): ?>
                <li>
                    <strong><?= htmlspecialchars($article['title']) ?></strong> - 
                    <em><?= htmlspecialchars($article['author']) ?></em>
                    <div class="article-content">
                        <?= nl2br(htmlspecialchars($article['content'])) ?>
                    </div>
                    <div class="article-meta">
                        <strong>Équipe :</strong> <?= htmlspecialchars($article['team'] ?? 'Non spécifiée') ?><br>
                        <strong>Joueur :</strong> <?= htmlspecialchars($article['player'] ?? 'Non spécifié') ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
