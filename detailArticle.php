<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Détail de l'article</title>
    <?php include 'config.php'; 
    session_start(); // Démarre la session si ce n'est pas déjà fait    
    ?>
</head>
<body>
    <h1>Détail de l'article</h1>

    <?php
        // Check if the article ID is provided in the URL
        if (isset($_GET['id'])) {
            $articleId = $_GET['id'];

            // Retrieve article details
            $articleSql = "SELECT articles.titre, articles.contenu, articles.date_creation, categorie.nomcategorie
                            FROM articles
                            INNER JOIN categorie ON articles.idcategorie = categorie.idcategorie
                            WHERE articles.id = ?";
            
            $articleStmt = $pdo->prepare($articleSql);
            $articleStmt->execute([$articleId]);
            
            if ($articleStmt->rowCount() > 0) {
                $articleRow = $articleStmt->fetch();
                echo '<div class="article">';
                echo '<h2>' . $articleRow['titre'] . '</h2>';
                echo '<p>' . $articleRow['contenu'] . '</p>';
                echo '<p>Date de publication : ' . $articleRow['date_creation'] . '</p>';
                echo '<p>Catégorie : ' . $articleRow['nomcategorie'] . '</p>';
                echo '</div>';
            } else {
                echo 'Article non trouvé.';
            }

            // Retrieve comments for the article
            $commentSql = "SELECT commentaires.contenu, commentaires.date_creation, users.pseudo
                            FROM commentaires
                            INNER JOIN users ON commentaires.iduser = users.iduser
                            WHERE commentaires.idarticle = ?
                            ORDER BY commentaires.date_creation DESC";
            
            $commentStmt = $pdo->prepare($commentSql);
            $commentStmt->execute([$articleId]);

            if ($commentStmt->rowCount() > 0) {
                echo '<div class="article">';
                echo '<h3>Commentaires :</h3>';
                echo '<ul>';
                while ($commentRow = $commentStmt->fetch()) {
                    echo '<li>';
                    echo '<p><strong>' . $commentRow['pseudo'] . '</strong> - ' . $commentRow['date_creation'] . '</p>';
                    echo '<p>' . $commentRow['contenu'] . '</p>';
                    echo '</li>';
                }
                echo '</ul>';
                echo '</div>';
            } else {
                echo '<p>Aucun commentaire pour cet article.</p>';
            }

            if(isset($_SESSION['pseudo'])) {
                $user = $_SESSION['pseudo'];
            
            echo '<form class="" action="ajouter_commentaire.php" method="POST">';
            echo '<label for="commentaire">Ajouter un commentaire :</label>';
            echo '<textarea rows="10" cols="40" name="commentaire" id="commentaire" required></textarea><br>';
            echo '<input type="hidden" name="articleId" value="' . $articleId . '">';
            echo '<input type="submit" value="Poster le commentaire">';
            echo '</form>';
            echo '</div>';
            }else{
                echo '<p>Vous devez être connecté pour poster un commentaire.</p>';
            }


        } else {
            echo 'ID de l\'article non fourni.';
        }

       echo '<button class="" onclick="history.go(-1);">Page précédente  </button>';


        $pdo = null;
    ?>
</body>
</html>
