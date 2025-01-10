<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des catégories</title>
</head>
<body>
    <h1>Gestion des catégories</h1>

    <!-- Formulaire pour ajouter une catégorie -->
    <form action="/projet-commerce-nba/public/categories" method="POST">
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" placeholder="Nom de la catégorie" required>
        <br>

        <label for="description">Description :</label>
        <textarea name="description" id="description" placeholder="Description"></textarea>
        <br>

        <button type="submit">Enregistrer</button>
    </form>

    <!-- Tableau pour afficher les catégories -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category['id'] ?></td>
                        <td><?= $category['name'] ?></td>
                        <td><?= $category['description'] ?></td>
                        <td>
                            <!-- Bouton pour supprimer -->
                            <a href="/projet-commerce-nba/public/categories/delete?id=<?= $category['id'] ?>"
                               onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">Supprimer</a>

                            <!-- Bouton pour modifier -->
                            <a href="/projet-commerce-nba/public/categories/edit?id=<?= $category['id'] ?>">Modifier</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Aucune catégorie trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Lien pour retourner à l'accueil -->
    <a href="/projet-commerce-nba/public/">Retour à l'accueil</a>
</body>
</html>
