<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une catégorie</title>
</head>
<body>
    <h1>Modifier une catégorie</h1>
    <form action="/projet-commerce-nba/public/categories/edit" method="POST">
        <input type="hidden" name="id" value="<?= $category['id'] ?>">
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" value="<?= $category['name'] ?>" required>
        <br>
        <label for="description">Description :</label>
        <textarea name="description" id="description"><?= $category['description'] ?></textarea>
        <br>
        <button type="submit">Mettre à jour</button>
    </form>
    <a href="/projet-commerce-nba/public/categories">Annuler</a>
</body>
</html>
