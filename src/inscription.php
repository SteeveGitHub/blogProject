<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    // Vérifier si le pseudo existe déjà dans la base de données
    $sql_check_pseudo = "SELECT COUNT(*) FROM users WHERE pseudo = ?";
    $stmt_check_pseudo = $pdo->prepare($sql_check_pseudo);
    $stmt_check_pseudo->execute([$pseudo]);
    $count_pseudo = $stmt_check_pseudo->fetchColumn();

    // Vérifier si l'adresse e-mail existe déjà dans la base de données
    $sql_check_email = "SELECT COUNT(*) FROM users WHERE email = ?";
    $stmt_check_email = $pdo->prepare($sql_check_email);
    $stmt_check_email->execute([$email]);
    $count_email = $stmt_check_email->fetchColumn();

    if ($count_pseudo > 0) {
        echo '<script>alert("Ce pseudo est déjà utilisé. Veuillez en choisir un autre.");</script>';
        header('Location: index.html');
    } elseif ($count_email > 0) {
        echo '<script>alert("Cet email est déjà utilisé. Veuillez en choisir un autre.");</script>';
        header('Location: index.html');
    } else {
        if (!empty($pseudo) && !empty($email) && !empty($pass)) {
            $sql = "INSERT INTO users (pseudo, email, pass) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);

            if ($stmt->execute([$pseudo, $email, $pass])) {
                echo '<script>alert("Inscription réussie !");</script>';
                $_SESSION['inscription_reussie'] = true;
                // Rediriger l'utilisateur vers la page de connexion après une inscription réussie
                header('Location: index.html');
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
