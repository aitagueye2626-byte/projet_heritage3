<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Erreur</title>
</head>
<body>
    <h1>Une erreur est survenue</h1>

    <p><?= htmlspecialchars($message ?? 'Erreur inconnue.') ?></p>

    <p><a href="/">Retour à l'accueil</a></p>
</body>
</html>