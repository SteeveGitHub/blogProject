<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Derniers Articles</title>
    <?php include 'config.php'; ?>
</head>
<body>
    <h1>Derniers Articles du Blog</h1>

    <?php
        // Modification de la requête pour inclure le champ etat
        $sql = "SELECT articles.id, articles.titre, articles.date_creation, categorie.nomcategorie, articles.etat
                FROM articles
                INNER JOIN categorie ON articles.idcategorie = categorie.idcategorie
                ORDER BY articles.date_creation DESC
                LIMIT 10";

        $result = $pdo->query($sql);

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $articleId = $row['id'];
                $articleTitle = htmlspecialchars($row['titre'], ENT_QUOTES, 'UTF-8');
                $articleDate = $row['date_creation'];
                $articleCategory = htmlspecialchars($row['nomcategorie'], ENT_QUOTES, 'UTF-8');
                $articleEtat = $row['etat'];

                // Affichage conditionnel selon l'état de l'article
                echo '<div class="article">';
                echo "<h2>$articleTitle</h2>";
                if ($articleEtat == 'valide') {
                    echo '<a href="detailArticle.php?id=' . $articleId . '">Consulter l\'article</a>';
                } elseif ($articleEtat == 'en_attente') {
                    echo '<p>En attente de validation</p>';
                } elseif ($articleEtat == 'rejete') {
                    echo '<p>Article rejeté</p>';
                }
                echo "<p>Date de publication : $articleDate</p>";
                echo "<p>Catégorie : $articleCategory</p>";
                echo '</div>';
            }
        } else {
            echo 'Aucun article trouvé.';
        }

        echo '<button onclick="history.go(-1);">Page précédente </button>';

        $pdo = null;
    ?>
</body>
</html>
