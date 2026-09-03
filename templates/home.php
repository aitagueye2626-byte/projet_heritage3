<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Soumettre une copie</title>
</head>
<body>
    <h1>Soumettre une copie d'examen</h1>

    <form action="/soumettre" method="POST">
        <div>
            <label for="note_brute">Note brute (sur 20)</label>
            <input type="number" step="0.01" min="0" max="20" id="note_brute" name="note_brute" required>
        </div>

        <div>
            <label for="date_depot">Date de dépôt</label>
            <input type="datetime-local" id="date_depot" name="date_depot" required>
        </div>

        <div>
            <label for="date_limite">Date limite</label>
            <input type="datetime-local" id="date_limite" name="date_limite" required>
        </div>

        <button type="submit">Soumettre</button>
    </form>

    <p><a href="/copies">Voir la liste des copies</a></p>
</body>
</html>