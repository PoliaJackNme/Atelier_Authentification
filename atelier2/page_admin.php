<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est en possession d'un cookie valide
if (isset($_COOKIE['authToken'])) {
    // Récupérer le jeton depuis le cookie
    $cookieuser = $_COOKIE['authToken'];

    // Afficher un message ou effectuer d'autres actions si le cookie est valide
} else {
    // Si le cookie n'existe pas ou est invalide, rediriger vers la page d'accueil
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <h1>Bienvenue sur la page Administrateur protégée par un Cookie</h1>
    <p>Vous êtes connecté en tant qu'admin.</p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
