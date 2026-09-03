<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail de la copie</title>
</head>
<body>
    <h1>Copie #<?= htmlspecialchars((string) $copie->getId()) ?></h1>

    <table border="1" cellpadding="8">
        <tr>
            <th>Note brute</th>
            <td><?= htmlspecialchars((string) $copie->getNoteBrute()) ?> / 20</td>
        </tr>
        <tr>
            <th>Note finale</th>
            <td><?= htmlspecialchars((string) $copie->getNoteFinale()) ?> / 20</td>
        </tr>
        <tr>
            <th>Pénalité appliquée</th>
            <td><?= $copie->isPenaliteAppliquee() ? 'Oui (retard)' : 'Non' ?></td>
        </tr>
        <tr>
            <th>Date de dépôt</th>
            <td><?= htmlspecialchars($copie->getDateDepot()->format('d/m/Y H:i')) ?></td>
        </tr>
        <tr>
            <th>Date limite</th>
            <td><?= htmlspecialchars($copie->getDateLimite()->format('d/m/Y H:i')) ?></td>
        </tr>
    </table>

    <p><a href="/copies">Retour à la liste</a></p>
</body>
</html>