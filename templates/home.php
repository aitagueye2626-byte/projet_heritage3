<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Soumettre une copie</title>

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
            max-width: 650px;
            margin: 60px auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #1f2937;
            margin-bottom: 30px;
        }

        .form-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 15px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
            margin-left: 8px;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Soumettre une copie d'examen</h1>

    <div class="form-card">

        <form action="/soumettre" method="POST">

            <div class="form-group">
                <label for="note_brute">
                    Note brute (sur 20)
                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    max="20"
                    id="note_brute"
                    name="note_brute"
                    required
                >
            </div>

            <div class="form-group">
                <label for="date_depot">
                    Date de dépôt
                </label>

                <input
                    type="datetime-local"
                    id="date_depot"
                    name="date_depot"
                    required
                >
            </div>

            <div class="form-group">
                <label for="date_limite">
                    Date limite
                </label>

                <input
                    type="datetime-local"
                    id="date_limite"
                    name="date_limite"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary">
                Soumettre
            </button>

            <a href="/copies" class="btn btn-secondary">
                Voir les copies
            </a>

        </form>

    </div>

</div>

</body>
</html>
