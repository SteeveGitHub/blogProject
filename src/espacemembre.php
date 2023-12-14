<?php

session_start(); // Démarre la session si ce n'est pas déjà fait
include 'config.php';

if(!isset($_SESSION['pseudo'])) {
    header('Location: connexion.html');
    exit;
}else{

    $user = $_SESSION['pseudo'];

echo "Bienvenue, " . $user . "!";
echo '<!DOCTYPE html>';
echo '<html lang="fr">';
echo '<head>';
echo '    <title>Espace Membre</title>';
echo '    <link rel="stylesheet" type="text/css" href="style.css">';
echo '</head>';
echo '<body>';
echo '    <div class="container">';
echo '        <h1>Bienvenue dans votre espace personnel !</h1>';
echo '        <a href="articles.php" class="btn-accueil">Lien vers les 10 derniers articles</a>';
echo '        <a href="deconnexion.php" class="btn-deconnexion">Deconnexion</a>';
echo '    </div>';
echo '</body>';
echo '</html>';

}
?>

