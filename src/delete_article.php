<?php
// Inclure votre fichier de connexion à la base de données ici
include_once 'db_connect.php';

// Vérifier si l'utilisateur est connecté et est un administrateur
// Vous devez implémenter une vérification sécurisée ici

// Vérifier si l'ID de l'article à supprimer est défini dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $article_id = $_GET['id'];

    // Préparer la requête de suppression
    $sql = "DELETE FROM articles WHERE id = :article_id";
    $stmt = $pdo->prepare($sql);

    // Lier les paramètres
    $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Rediriger vers la page d'affichage des articles après la suppression
        header('Location: articles.php');
        exit();
    } else {    
        echo "Erreur lors de la suppression de l'article.";
    }
} else {
    echo "ID d'article non valide.";
}
?>
