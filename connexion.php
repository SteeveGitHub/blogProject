<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pseudo']) && isset($_POST['mot_de_passe'])) {
    $pseudo = $_POST['pseudo'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hasher le mot de passe

    // Vérifier si l'email existe déjà
    $sql = "SELECT id FROM users WHERE pseudo = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$pseudo]);

    if ($stmt->rowCount() > 0) {
        echo "L'utilisateur avec ce pseudo existe déjà. Veuillez choisir un autre pseudo.";
        echo '<script>alert("Ce pseudo est déjà pris. Veuillez en choisir un autre.");</script>';
    } else {
        // Insérer le nouvel utilisateur
        $sql = "INSERT INTO users (pseudo, pass) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$pseudo, $mot_de_passe]);
        echo "Inscription réussie. Bienvenue, " . $pseudo . "!";
        echo '<script>alert("Inscription réussie !");</script>';
    }
}
?>
