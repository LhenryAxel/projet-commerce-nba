<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un article NBA</title>
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
            max-width: 600px;
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
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        form button {
            display: inline-block;
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

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }

        .back-btn:hover {
            background-color: #5a6268;
        }

        .form-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Créer un article NBA</h1>
        <form action="/projet-commerce-nba/public/nba_articles/create" method="POST">
            <label for="title">Titre :</label>
            <input type="text" name="title" id="title" required><br>

            <label for="content">Contenu :</label>
            <textarea name="content" id="content" required></textarea><br>

            <label for="author">Auteur :</label>
            <input type="text" name="author" id="author" required><br>

            <label for="team">Équipe :</label>
            <input type="text" name="team" id="team"><br>

            <label for="player">Joueur :</label>
            <input type="text" name="player" id="player"><br>

            <button type="submit">Créer</button>
        </form>
        <a href="/projet-commerce-nba/public" class="back-btn">Retour à l'accueil</a>
    </div>
</body>
</html>
