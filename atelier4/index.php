<?php
// Liste des utilisateurs et mots de passe
$users = [
    'admin' => 'secret',  // Accès complet
    'user' => '1234'      // Accès limité
];

// Vérifier si l'utilisateur a envoyé des identifiants
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    // Envoyer un header HTTP pour demander les informations
    header('WWW-Authenticate: Basic realm="Zone Protégée"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Vous devez entrer un nom d\'utilisateur et un mot de passe pour accéder à cette page.';
    exit;
}

// Vérifier les identifiants envoyés
$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

if (!array_key_exists($username, $users) || $users[$username] !== $password) {
    // Si les identifiants sont incorrects
    header('WWW-Authenticate: Basic realm="Zone Protégée"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Nom d\'utilisateur ou mot de passe incorrect.';
    exit;
}

// Contenu selon le rôle
$is_admin = ($username === 'admin');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page protégée</title>
</head>
<body>
    <h1>Bienvenue sur la page protégée</h1>
    <p>Vous êtes connecté en tant que : <strong><?php echo htmlspecialchars($username); ?></strong></p>

    <?php if ($is_admin): ?>
        <h2>Contenu complet pour l'administrateur</h2>
        <p>Ceci est une page avec un accès complet pour l'utilisateur admin.</p>
        <p>Vous avez accès à toutes les fonctionnalités et informations disponibles.</p>
    <?php else: ?>
        <h2>Contenu limité pour l'utilisateur</h2>
        <p>Ceci est une page avec un accès limité pour l'utilisateur standard.</p>
        <p>Certaines sections sont réservées aux administrateurs.</p>
    <?php endif; ?>

    <a href="../index.html">Retour à l'accueil</a>
</body>
</html>
