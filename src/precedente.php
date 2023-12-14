<?php
// Récupérer l'URL de la page précédente
$previousPage = $_SERVER['HTTP_REFERER'];

// Rediriger vers la page précédente
header("Location: $previousPage");
exit();
?>
