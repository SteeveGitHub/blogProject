<?php
session_start(); // Démarrer la session

// Détruire la session pour déconnecter l'utilisateur
session_destroy();

// Rediriger l'utilisateur vers la page d'inscription
header('Location: inscription.html');
exit;
?>
