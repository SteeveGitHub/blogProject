<?php

session_start();
include 'config.php';

// Vérifier si l'utilisateur est un administrateur
if ($_SESSION['isAdmin'] !== 1) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas un admin
    header('Location: connexion.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Espace Admin</title>
</head>
<body>

<?php
echo "<h1>Administration des Articles</h1>";

// Afficher les articles en état "en_attente"
$sqlEnAttente = "SELECT * FROM articles WHERE etat = 'en_attente'";
$resultEnAttente = $pdo->query($sqlEnAttente);

if ($resultEnAttente->rowCount() > 0) {
    echo "<h2>Articles en Attente</h2>";
    while ($rowEnAttente = $resultEnAttente->fetch()) {
        echo "<div class='article'>";
        echo "<h3>" . $rowEnAttente['titre'] . "</h3>";
        // Ajouter des liens ou des boutons pour les actions que vous souhaitez
        echo "<a href='valider_article.php?id=" . $rowEnAttente['id'] . "'>Valider</a> | ";
        echo "<a href='rejeter_article.php?id=" . $rowEnAttente['id'] . "'>Rejeter</a> | ";
        echo "<a href='supprimer_article.php?id=" . $rowEnAttente['id'] . "'>Supprimer</a>";
        echo "</div>";
    }
} else {
    echo "<p>Aucun article en attente.</p>";
}

// Afficher les articles en état "valide"
$sqlValide = "SELECT * FROM articles WHERE etat = 'valide'";
$resultValide = $pdo->query($sqlValide);

if ($resultValide->rowCount() > 0) {
    echo "<h2>Articles Validés</h2>";
    while ($rowValide = $resultValide->fetch()) {
        echo "<div class='article'>";
        echo "<h3>" . $rowValide['titre'] . "</h3>";
        // Ajouter des liens ou des boutons pour les actions que vous souhaitez
        echo "<a href='#'>Modifier</a> | ";
        echo "<a href='supprimer_article.php?id=" . $rowValide['id'] . "'>Supprimer</a>";
        echo "</div>";
    }
} else {
    echo "<p>Aucun article validé.</p>";
}

// Afficher les articles en état "rejete"
$sqlRejete = "SELECT * FROM articles WHERE etat = 'rejete'";
$resultRejete = $pdo->query($sqlRejete);

if ($resultRejete->rowCount() > 0) {
    echo "<h2>Articles Rejetés</h2>";
    while ($rowRejete = $resultRejete->fetch()) {
        echo "<div class='article'>";
        echo "<h3>" . $rowRejete['titre'] . "</h3>";
        // Ajouter des liens ou des boutons pour les actions que vous souhaitez
        echo "<a href='#'>Modifier</a> | ";
        echo "<a href='supprimer_article.php?id=" . $rowRejete['id'] . "'>Supprimer</a>";
        echo "</div>";
    }
} else {
    echo "<p>Aucun article rejeté.</p>";
}

echo '<a href="deconnexion.php" class="btn-deconnexion">Deconnexion</a>';

?>
