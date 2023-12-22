<?php
session_start();
include 'config.php';

// Vérifiez si l'utilisateur est connecté et a les autorisations nécessaires
// (ajoutez votre propre logique de vérification ici)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $idcategorie = $_POST['idcategorie'];

    // Insérer les données dans la base de données
    $sql = "INSERT INTO articles (titre, contenu, idcategorie, etat) VALUES (?, ?, ?, 'en_attente')";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$titre, $contenu, $idcategorie])) {
        echo '<script>alert("Article créé et en attente de validation.");</script>';

    } else {
        echo '<script>alert("Erreur lors de la création de l\'article.");</script>';
    }
}

// Récupérer les catégories pour le menu déroulant
$sqlCategorie = "SELECT idcategorie, nomcategorie FROM categorie";
$stmtCategorie = $pdo->query($sqlCategorie);
$categories = $stmtCategorie->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Créer un Article</title>
</head>
<body>
    <h1>Créer un Nouvel Article</h1>
    <form action="creer_article.php" method="post">
        <label for="titre">Titre:</label><br>
        <input type="text" id="titre" name="titre" required><br>

        <label for="contenu">Contenu:</label><br>
        <textarea id="contenu" name="contenu" required></textarea><br>

        <label for="idcategorie">Catégorie:</label><br>
        <select id="idcategorie" name="idcategorie" required>
            <?php foreach ($categories as $categorie): ?>
                <option value="<?= htmlspecialchars($categorie['idcategorie']) ?>"><?= htmlspecialchars($categorie['nomcategorie']) ?></option>
            <?php endforeach; ?>
        </select><br>

        <input type="submit" value="Créer l'Article">
    </form>

    <?php echo '<button onclick="history.go(-1);">Page précédente </button>';
    ?>

</body>
</html>
