# Installation
Pour commencer le projet, vous dezvez télécharger les dépendances avec Composer et NPM (ou yarn)
```
$ composer install
$ npm install
```
Une fois l'installation terminé, ouvrez le fichier `.env` et modifier les identifiants et le nom de la base de données pour correspondre avec votre configuration locale
```
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
# db_user: utilisateur de la base de données
# db_password: mot de passe de l'utilisateur
# db_name: nom de la base de donnée a créer/utiliser
```

Pour utiliser des données de tests (5 catégorie + 100 articles), importez le fichier `datatest.sql` dans votre base de données.

Et pour terminer, vous devez générer les assets en utilisant Webpack:
```bash
$ encore prod
```
(ou `$ encore dev` si vous êtes en environnement de développement)

# Consigne du projet

Votre mission est de créer un mini-site composé de deux parties :

### Côté Back :

-> 1 base de données MySQL qui comprend des articles, et des catégories d'articles

-> Chaque article est composée de :
- Une catégorie
- Une image
- Un titre
- Un description
- Une date de publication

### Côté Front :

-> 1 page d'accueil qui liste les articles de votre base de données dans l'ordre chronologique.

-> Sur cette page, il faudra la présence d'un filtre des catégories pour les articles. Lorsqu'on choisit une catégorie dans ce filtre, seuls les articles de la catégorie doivent apparaître.

-> Sur cette page d'accueil, il vous faudra également effectuer une remontée de post du réseau social de votre choix parmi la liste suivante : Twitter, Instagram, Facebook, Linkedin (le votre ou celui de votre choix)
- Sans utiliser de Javascript, uniquement du PHP.

-> Un article (détails) doit être accessible également via une URL unique.

-> 1 page contact avec un formulaire;

-> Voici les champs :
- Civilité (Mme / M) - radio
- Nom - text
- Prénom - text
- E-mail - text
- Objet (Recrutement, Support, Marketing) - list
- Message - text

Ce formulaire doit envoyer un e-mail sur l'email de l'administrateur en remontant toutes les infos renseignées par l'utilisateur. Vous devrez utiliser bootstrap ou materialize pour le minimum de mise en page côté Front. Pour cette mission vous pouvez utiliser un framework ou non, c'est à vous de voir. Vous devrez nous envoyer l'exercice terminé pour que nous puissions l'installer sur notre machine locale (MAMP, PHP, MySQL). A vous de nous fournir un readme et/ou documentation si spécialité.
