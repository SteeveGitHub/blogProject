<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    // Vérifier si le pseudo existe déjà dans la base de données
    $sql_check = "SELECT COUNT(*) FROM contact WHERE pseudo = ?";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([$pseudo]);
    $count = $stmt_check->fetchColumn();

    if ($count > 0) {
        echo '<script>alert("Ce pseudo est déjà utilisé. Veuillez en choisir un autre.");</script>';
    } else {
        if (!empty($pseudo) && !empty($email) && !empty($mot_de_passe)) {
            $sql = "INSERT INTO contact (pseudo, pass) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([$pseudo, $mot_de_passe])) {
                echo '<script>alert("Inscription réussie !");</script>'; 
                // Rediriger l'utilisateur vers la page de connexion après une inscription réussie
                header('Location: connexion.html');
                exit; // Arrêter le script PHP
            } else {
                echo '<script>alert("Erreur lors de l\'inscription.");</script>';
                echo "Erreur lors de l'inscription.";
            }
        } else {
            echo "Tous les champs sont obligatoires.";
        }
    }
}
?>
