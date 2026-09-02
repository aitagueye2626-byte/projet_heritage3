CREATE TABLE copie_examen (
    id SERIAL PRIMARY KEY,
    date_depot TIMESTAMP NOT NULL DEFAULT NOW(),
    note_brute NUMERIC(4, 2) NOT NULL CHECK (note_brute BETWEEN 0 AND 20),
    note_finale NUMERIC(4, 2) NOT NULL CHECK (note_finale >= 0),
    penalite_appliquee BOOLEAN NOT NULL DEFAULT FALSE,
    date_limite TIMESTAMP NOT NULL
);

INSERT INTO copie_examen (note_brute, note_finale, penalite_appliquee, date_limite)
VALUES (10, 15.5, false, '2026-09-15 00:59:00');
SELECT*FROM copie_examen;
