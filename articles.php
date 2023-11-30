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
        // Affichage des articles
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
                
                // Affichage des commentaires
                $articleId = $row['id'];
                $commentSql = "SELECT commentaires.contenu, commentaires.date_creation, users.pseudo
                               FROM commentaires
                               INNER JOIN users ON commentaires.iduser = users.iduser
                               WHERE commentaires.idarticle = ?
                               ORDER BY commentaires.date_creation DESC
                               LIMIT 5";

                $commentStmt = $pdo->prepare($commentSql);
                $commentStmt->execute([$articleId]);

                if ($commentStmt->rowCount() > 0) {
                    echo '<h3>Commentaires :</h3>';
                    echo '<ul>';
                    while ($commentRow = $commentStmt->fetch()) {
                        echo '<li>';
                        echo '<p><strong>' . $commentRow['pseudo'] . '</strong> - ' . $commentRow['date_creation'] . '</p>';
                        echo '<p>' . $commentRow['contenu'] . '</p>';
                        echo '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>Aucun commentaire pour cet article.</p>';
                }

                // Formulaire pour ajouter un commentaire
                echo '<form action="ajouter_commentaire.php" method="POST">';
                echo '<label for="commentaire">Ajouter un commentaire :</label>';
                echo '<textarea name="commentaire" id="commentaire" rows="4" cols="50" required></textarea><br>';
                echo '<input type="hidden" name="articleId" value="' . $articleId . '">';
                echo '<input type="submit" value="Poster le commentaire">';
                echo '</form>';

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
