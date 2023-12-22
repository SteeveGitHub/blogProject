<?php

session_start();
include 'config.php';

// Vérifier si l'utilisateur est un administrateur
if ($_SESSION['isAdmin'] !== 1) {
    header('Location: connexion.html');
    exit;
}

if (isset($_GET['id'])) {
    $articleId = $_GET['id'];

    $sql = "UPDATE articles SET etat = 'valide' WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$articleId]);

    if ($stmt->rowCount() > 0) {
        echo '<script>alert("Article validé avec succès.");</script>';
    } else {
        echo '<script>alert("Erreur lors de la validation de l\'article.");</script>';
    }
}

header('Location: admin.php');
exit;
?>
