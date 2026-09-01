# Système de notation universitaire

Projet PHP permettant de gérer le traitement des copies d'examen.

## Partie 0 — Initialisation

Cette partie consiste à initialiser le dépôt Git et à mettre en place les premières règles de versionnement.

## Questions

### Pourquoi le dossier /vendor ne doit-il pas être versionné ?

Le dossier `vendor/` contient les dépendances installées par Composer.
Ces dépendances peuvent être recréées à partir des fichiers de configuration de Composer.
Il n'est donc pas nécessaire de les versionner dans Git.

### Quelle différence existe entre un commit et un tag ?

Un commit enregistre une modification dans l'historique du projet.
Un tag est une étiquette permettant d'identifier un commit précis, généralement pour marquer une version du projet.

Le tag `v0.0.0` permet d'identifier la première version du projet.

### Pourquoi la branche main doit-elle rester stable ?

La branche `main` doit contenir une version fonctionnelle et stable du projet.
Les nouvelles fonctionnalités doivent être développées dans des branches séparées avant d'être intégrées dans `main`.
Cela permet d'éviter d'avoir une version principale cassée.

