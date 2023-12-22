<?php

session_start();
include 'config.php';
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

// Vérifier si l'utilisateur est un administrateur
if ($_SESSION['isAdmin'] !== 1) {
    header('Location: connexion.html');
    exit;
}

echo "<h1>Administration des Articles</h1>";

$sql = "SELECT * FROM articles WHERE etat = 'en_attente'";
$result = $pdo->query($sql);

if ($result->rowCount() > 0) {
    while ($row = $result->fetch()) {
        echo "<div class='article'>";
        echo "<h2>" . $row['titre'] . "</h2>";
        // Ajouter des boutons ou des liens pour valider ou rejeter
        echo "<a href='valider_article.php?id=" . $row['id'] . "'>Valider</a> | ";
        echo "<a href='rejeter_article.php?id=" . $row['id'] . "'>Rejeter</a>";
        echo '<a href="deconnexion.php" class="btn-deconnexion">Deconnexion</a>';

        echo "</div>";
    }
} else {
    echo "Aucun article en attente de validation.";
    echo '<a href="deconnexion.php" class="btn-deconnexion">Deconnexion</a>';

}
?>


</body>
</html>