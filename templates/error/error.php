<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Erreur</title>

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

        .error-container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
        }

        .error-card {
            background: white;
            padding: 35px;
            border-radius: 12px;
            border-top: 5px solid #dc2626;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #dc2626;
            margin-bottom: 20px;
        }

        .message {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 25px;
        }

        .back {
            display: inline-block;
            padding: 11px 18px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .back:hover {
            background: #1d4ed8;
        }
    </style>
</head>

<body>

<div class="error-container">

    <div class="error-card">

        <h1>Une erreur est survenue</h1>

        <div class="message">
            <?= htmlspecialchars($message ?? 'Erreur inconnue.') ?>
        </div>

        <a href="/" class="back">
            ← Retour à l'accueil
        </a>

    </div>

</div>

</body>
</html>
