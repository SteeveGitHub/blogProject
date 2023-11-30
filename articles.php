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
            ?>
            <div class="article">
                <h2><?php echo $row['titre']; ?></h2>
                <p><?php echo $row['contenu']; ?></p>
                <p>Date de publication : <?php echo $row['date_creation']; ?></p>
                <p>Catégorie : <?php echo $row['nomcategorie']; ?></p>
            </div>
            <?php
        }
    } else {
        echo 'Aucun article trouvé.';
    }

    // Fermer la connexion à la base de données
    $pdo = null;
    ?>

</body>
</html>
