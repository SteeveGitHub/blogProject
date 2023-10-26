<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $sql = "SELECT * FROM contact WHERE pseudo = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$pseudo]);
    $user = $stmt->fetch();

    if ($user && password_verify($mot_de_passe, $user['pass'])) {
        // Connexion réussie
        echo "Connexion réussie. Bienvenue, " . $user['pseudo'] . "!";
        echo '<script>alert("Connexion réussie !");</script>'; 
        // Rediriger l'utilisateur vers la page "espacemembre.html" après la connexion réussie
        header('Location: espacemembre.html');
        exit; // Arrêter le script PHP
    } else {
        // Identifiants incorrects
        echo "Identifiants incorrects. Veuillez réessayer.";
        echo '<script>alert("Login Faux !");</script>'; 
    }
}
?>
