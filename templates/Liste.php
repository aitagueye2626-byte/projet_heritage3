<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des copies</title>

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
            width: 90%;
            max-width: 1100px;
            margin: 50px auto;
        }

        h1 {
            color: #1f2937;
            margin-bottom: 25px;
        }

        .top-bar {
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .table-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #2563eb;
            color: white;
            padding: 13px;
            text-align: left;
        }

        td {
            padding: 13px;
            border-bottom: 1px solid #e5e7eb;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        .empty {
            padding: 20px;
            background: white;
            border-radius: 10px;
            color: #6b7280;
        }

        .status-yes {
            color: #dc2626;
            font-weight: bold;
        }

        .status-no {
            color: #16a34a;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Copies enregistrées</h1>

    <div class="top-bar">
        <a href="/soumettre" class="btn btn-primary">
            + Soumettre une nouvelle copie
        </a>
    </div>

    <?php if (empty($copies)): ?>

        <div class="empty">
            Aucune copie enregistrée pour le moment.
        </div>

    <?php else: ?>

        <div class="table-card">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Note brute</th>
                        <th>Note finale</th>
                        <th>Pénalité</th>
                        <th>Date de dépôt</th>
                        <th>Détail</th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach ($copies as $copie): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars((string) $copie->getId()) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string) $copie->getNoteBrute()) ?>
                            / 20
                        </td>

                        <td>
                            <?= htmlspecialchars((string) $copie->getNoteFinale()) ?>
                            / 20
                        </td>

                        <td>
                            <?php if ($copie->isPenaliteAppliquee()): ?>
                                <span class="status-yes">Oui</span>
                            <?php else: ?>
                                <span class="status-no">Non</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $copie->getDateDepot()->format('d/m/Y H:i')
                            ) ?>
                        </td>

                        <td>
                            <a
                                href="/copies/<?= htmlspecialchars((string) $copie->getId()) ?>"
                                class="btn btn-primary"
                            >
                                Voir
                            </a>
                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

</div>

</body>
</html>
