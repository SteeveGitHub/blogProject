<?php

session_start();
include 'config.php';

// Vérifier si l'utilisateur est un administrateur
if ($_SESSION['isAdmin'] !== 1) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas un admin
    header('Location: connexion.html');
    exit;
}

// Vérifier si l'ID de l'article est fourni dans l'URL
if (isset($_GET['id'])) {
    $articleId = $_GET['id'];

    // Préparer la requête SQL pour supprimer l'article
    $sql = "DELETE FROM articles WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    // Exécuter la requête
    if ($stmt->execute([$articleId])) {
        // Si la suppression est réussie, rediriger vers la page d'administration avec un message
        $_SESSION['message'] = "Article supprimé avec succès.";
        header('Location: admin.php');
        exit;
    } else {
        // Si la suppression échoue, afficher un message d'erreur
        echo "Erreur lors de la suppression de l'article.";
    }
} else {
    echo "ID de l'article non spécifié.";
}
?>
