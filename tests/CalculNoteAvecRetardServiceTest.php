<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Service\CalculNoteAvecRetardService;

$calcul = new CalculNoteAvecRetardService();

$resultat = $calcul->calculer(15.0, false);
assert($resultat === 15.0, "Échec : dépôt à temps devrait garder la note (attendu 15.0, obtenu $resultat)");

$resultat = $calcul->calculer(15.0, true);
assert($resultat === 13.0, "Échec : retard devrait retirer 2 points (attendu 13.0, obtenu $resultat)");

$resultat = $calcul->calculer(1.0, true);
assert($resultat === 0.0, "Échec : la note ne doit jamais être négative (attendu 0.0, obtenu $resultat)");

assert(
    $calcul instanceof \App\Service\CalculNoteInterface,
    "Échec : CalculNoteAvecRetardService doit implémenter CalculNoteInterface"
);

echo "Tous les tests sont passés avec succès.\n";