<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['commentaire']) && isset($_POST['articleId'])) {
    $commentaire = $_POST['commentaire'];
    $articleId = $_POST['articleId'];

    session_start();

    if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];

        $insertSql = "INSERT INTO commentaires (idarticle, iduser, contenu) VALUES (?, ?, ?)";
        $insertStmt = $pdo->prepare($insertSql);

        if ($insertStmt->execute([$articleId, $userId, $commentaire])) {
            echo "Commentaire ajouté avec succès!";
            header('Location: detailArticle.php?id=' . $articleId . '');
        } else {
            echo "Erreur lors de l'ajout du commentaire.";
        }
    } else {
        echo "Veuillez vous connecter pour ajouter un commentaire.";
    }
}
?>
