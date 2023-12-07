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
        $sql = "SELECT articles.id, articles.titre, articles.date_creation, categorie.nomcategorie
                FROM articles
                INNER JOIN categorie ON articles.idcategorie = categorie.idcategorie
                ORDER BY articles.date_creation DESC
                LIMIT 10";

        $result = $pdo->query($sql);

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $articleId = $row['id'];
                $articleTitle = $row['titre'];
                $articleDate = $row['date_creation'];
                $articleCategory = $row['nomcategorie'];

                // Create a link to the detailArticle.php file with the article ID as a parameter
                echo '<div class="article">';
                echo '<h2><a href="detailArticle.php?id=' . $articleId . '">' . $articleTitle . '</a></h2>';
                echo '<p>Date de publication : ' . $articleDate . '</p>';
                echo '<p>Catégorie : ' . $articleCategory . '</p>';
                echo '</div>';

            }
        } else {
            echo 'Aucun article trouvé.';
        }

        echo '<button onclick="history.go(-1);">Precedent </button>';

        $pdo = null;
    ?>
</body>
</html>
