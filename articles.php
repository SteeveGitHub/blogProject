<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Derniers Articles</title>
    <?php include 'config.php'; ?>
</head>
<body>
<h1>Derniers Articles du Blog</h1>

<?php
    // Requête SQL pour récupérer les 10 derniers articles
    $sql = "SELECT articles.id, articles.titre, articles.contenu, articles.date_creation, categorie.nomcategorie
            FROM articles
            INNER JOIN categorie ON articles.idcategorie = categorie.idcategorie
            ORDER BY articles.date_creation DESC
            LIMIT 10";

    $result = $pdo->query($sql);

if ($result->rowCount() > 0) {
while ($row = $result->fetch()) {
echo '<div class="article">';
    echo '<h2>' . $row['titre'] . '</h2>';
    echo '<p>' . $row['contenu'] . '</p>';
    echo '<p>Date de publication : ' . $row['date_creation'] . '</p>';
    echo '<p>Catégorie : ' . $row['nomcategorie'] . '</p>';
    echo '</div>';
}
} else {
echo 'Aucun article trouvé.';
}

// Fermer la connexion à la base de données
$pdo = null;
?>

</body>
</html>
