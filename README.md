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

Questions — Partie 1
Pourquoi placer index.php dans un dossier public ?

Le fichier index.php est placé dans le dossier public afin que seul le contenu destiné à être accessible par le navigateur soit exposé publiquement.


Les fichiers contenant la logique métier, les informations de connexion à la base de données, les requêtes SQL et les classes internes restent en dehors du dossier public. Cela améliore la sécurité de l'application.
Pourquoi toutes les requêtes devraient-elles passer par ce fichier ?

public/index.php constitue le point d'entrée unique de l'application. Toutes les requêtes HTTP passent par ce fichier afin de centraliser leur traitement.

Il permet notamment de charger automatiquement les classes, de récupérer la requête, de déterminer la route à utiliser et de transmettre la demande au contrôleur approprié.

Cette organisation facilite également la maintenance et permet d'appliquer un contrôle commun à toutes les requêtes.
Quels éléments ne devraient jamais se trouver dans le dossier public ?

Le dossier public ne doit pas contenir :

    les informations de connexion à la base de données ;
    les mots de passe ;
    les classes métier ;
    les repositories ;
    les services ;
    les fichiers de configuration ;
    les scripts SQL ;
    les données sensibles ou fichiers internes de l'application.

Seuls les fichiers qui doivent réellement être accessibles par le navigateur doivent être placés dans public.
# Partie 3 — Préparer la persistance

## Questions

**1. Quelle classe doit être responsable de la connexion ?**

`Database` (dans `src/Container/`), et elle seule. Aucune autre classe (Repository,
Service, Controller) ne doit ouvrir sa propre connexion PDO — elles passent toutes
par `Database::getInstance()->getConnection()`.

**2. Faut-il créer une nouvelle connexion pour chaque requête SQL ?**

Non. Ouvrir une connexion PDO est coûteux. `Database` est un Singleton :
`getInstance()` crée la connexion une seule fois, puis renvoie toujours la même
ensuite — toutes les requêtes partagent cette unique connexion.

**3. Où placer les identifiants de connexion ?**

Dans un fichier de configuration séparé du code source (`config/database.php`),
jamais écrits en dur dans une classe PHP.

**4. Pourquoi utiliser PDO ?**

- Sécurité : requêtes préparées, protection contre les injections SQL
- Portabilité : fonctionne avec plusieurs moteurs de base de données
- Gestion d'erreurs unifiée via les exceptions PHP