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

. Pourquoi créer un objet supplémentaire ?

$_POST contient des données brutes, souvent sous forme de chaînes. Le DTO permet de valider et convertir ces données avant de les transmettre au métier.
2. Différence avec CopieExamen

SoumettreCopieDTO sert uniquement à transporter les données du formulaire.

CopieExamen est une entité métier qui contient des règles, comme le calcul de la note finale.
3. Le DTO doit-il avoir un identifiant ?

Non. Il contient uniquement :

    noteBrute
    dateDepot
    dateLimite

4. Où convertir les dates ?

La conversion doit se faire lors de la création du DTO, avant d'envoyer les données aux classes métier.

# Partie 4


    Pourquoi créer un objet supplémentaire alors que $_POST contient déjà les données ?
    $_POST contient uniquement des données brutes provenant du formulaire, généralement sous forme de chaînes de caractères. Créer un objet permet de transformer ces données en une structure correspondant à un concept métier de l’application, avec des propriétés et éventuellement des méthodes. Cela respecte mieux le principe de la programmation orientée objet et facilite la validation et le traitement des données.

    Quelle différence observez-vous entre cet objet et CopieExamen ?
    L’objet créé à partir de $_POST représente généralement les données saisies par l’utilisateur avant leur enregistrement en base de données.
    CopieExamen, lui, représente une entité persistante, c’est-à-dire un objet correspondant à un enregistrement de la base de données et pouvant posséder un identifiant (id).

    Cet objet doit-il posséder un identifiant de base de données ?
    Non, pas nécessairement. Si l’objet représente simplement les données envoyées par le formulaire avant leur insertion en base, il n’a pas encore d’identifiant. L’id sera généralement attribué par la base de données au moment de l’insertion.

    Où la conversion des chaînes de dates doit-elle avoir lieu ?
    La conversion doit idéalement avoir lieu lors de la transformation des données brutes ($_POST) en objet métier, et non dans $_POST lui-même. Par exemple, une chaîne comme "2026-09-02" peut être transformée en objet DateTime/DateTimeImmutable avant d’être utilisée par le reste de l’application.

En résumé

    $_POST → données brutes → objet de données → objet métier (CopieExamen) → base de données.

Cela permet de séparer clairement la réception des données, leur transformation/validation et leur enregistrement en base de données.
