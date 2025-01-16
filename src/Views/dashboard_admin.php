<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBA Store Admin</title>
    <link rel="stylesheet" href="/projet-commerce-nba/public/css/style.css">
</head>
<body>
    <header class="admin-header">
        <h1>NBA Store - Tableau de bord</h1>
        <nav>
            <a href="/projet-commerce-nba/public/logout" class="logout-btn">Déconnexion</a>
        </nav>
    </header>
    <main class="dashboard">
        <h2>Bienvenue sur le tableau de bord administrateur</h2>
        <br>
        <div class="dashboard-cards">
            <a href="/projet-commerce-nba/public/categories" class="dashboard-card">
                <h2>Catégories</h2>
                <p>Gérer les catégories de produits.</p>
            </a>
            <a href="/projet-commerce-nba/public/products" class="dashboard-card">
                <h2>Produits</h2>
                <p>Ajouter, modifier ou supprimer des produits.</p>
            </a>
            <a href="/projet-commerce-nba/public/users" class="dashboard-card">
                <h2>Utilisateurs</h2>
                <p>Gérer les administrateurs et les clients.</p>
            </a>
            <a href="/projet-commerce-nba/public/nba_articles" class="dashboard-card">
                <h2>Articles NBA</h2>
                <p>Voir tous les articles NBA.</p>
            </a>
            <a href="/projet-commerce-nba/public/nba_articles/create" class="dashboard-card">
                <h2>Créer un article</h2>
                <p>Ajouter un nouvel article NBA.</p>
            </a>
        </div>
    </main>
    <footer class="admin-footer">
        <p>&copy; <?= date('Y') ?> NBA Store Admin. Tous droits réservés.</p>
    </footer>
</body>
</html>
