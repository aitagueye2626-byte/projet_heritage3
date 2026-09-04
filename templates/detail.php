<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail de la copie</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #333;
        }

        .container {
            max-width: 750px;
            margin: 60px auto;
            padding: 20px;
        }

        h1 {
            color: #1f2937;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            width: 45%;
            background: #f3f4f6;
            text-align: left;
            padding: 14px;
            border-bottom: 1px solid #ddd;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
        }

        .note-finale {
            font-weight: bold;
            color: #2563eb;
        }

        .penalite-oui {
            color: #dc2626;
            font-weight: bold;
        }

        .penalite-non {
            color: #16a34a;
            font-weight: bold;
        }

        .back {
            display: inline-block;
            margin-top: 25px;
            padding: 11px 18px;
            background: #6b7280;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }

        .back:hover {
            background: #4b5563;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>
        Copie #<?= htmlspecialchars((string) $copie->getId()) ?>
    </h1>

    <div class="card">

        <table>

            <tr>
                <th>Note brute</th>
                <td>
                    <?= htmlspecialchars((string) $copie->getNoteBrute()) ?>
                    / 20
                </td>
            </tr>

            <tr>
                <th>Note finale</th>
                <td class="note-finale">
                    <?= htmlspecialchars((string) $copie->getNoteFinale()) ?>
                    / 20
                </td>
            </tr>

            <tr>
                <th>Pénalité appliquée</th>
                <td>
                    <?php if ($copie->isPenaliteAppliquee()): ?>
                        <span class="penalite-oui">
                            Oui (retard)
                        </span>
                    <?php else: ?>
                        <span class="penalite-non">
                            Non
                        </span>
                    <?php endif; ?>
                </td>
            </tr>

            <tr>
                <th>Date de dépôt</th>
                <td>
                    <?= htmlspecialchars(
                        $copie->getDateDepot()->format('d/m/Y H:i')
                    ) ?>
                </td>
            </tr>

            <tr>
                <th>Date limite</th>
                <td>
                    <?= htmlspecialchars(
                        $copie->getDateLimite()->format('d/m/Y H:i')
                    ) ?>
                </td>
            </tr>

        </table>

        <a href="/copies" class="back">
            ← Retour à la liste
        </a>

    </div>

</div>

</body>
</html>
