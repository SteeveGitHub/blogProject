<?php
include 'config.php';

if (($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_POST['pseudo'])) && (isset($_POST['pass']))) {
    $pseudo = $_POST['pseudo'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE pseudo = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$pseudo]);
    $user = $stmt->fetch();

    if ($user && password_verify($pass, $user['pass'])) {
        // Connexion réussie
        echo "Connexion réussie. Bienvenue, " . $user['pseudo'] . "!";
        echo '<script>alert("Connexion réussie !");</script>';
        header('Location: espacemembre.html');
        exit;
    } else {
        echo "Identifiants incorrects. Veuillez réessayer.";
        echo '<script>alert("Login Faux !");</script>';
    }
}
?>