# =============== Projet 4 ================
## Projet 4 OpenClassrooms : Création d'un nouveau système de réservation et de gestion des tickets en ligne (Musée du Louvre)
### Projet sous Symfony 3.3.4
_______________________________________________________

## 1er Commit : Installation Framework Symfony

Ce commit comprend :
- Installation des composants de base de Symfony 3.3.4
- Création d'une maquette du Projet4 **(web/Maquette.html)** positionnant tous les éléments demandés dans le projet et montrant la navigation.
- Elaboration Charte Graphique (Nuance de bleu, Material Design).
- Création du fichier CSS **(web/css/projet4.css)**.

_______________________________________________________

## 2eme Commit : Création de BookingBundle et des vues associées & entité Reservation

Ce commit comprend :
- Création du Bundle **BookingBundle** dans le répertoire **src/Louvre**.
- Mise à jour des composants avec composer
- Création de la vue générale **layout.html.twig**
- Création de la vue Homepage **home.html.twig**
- Création de la vue réservation **Booking.html.twig**
- Ajout de l'information Nombre de places disponibles pour aujourd'hui dans la vue et la maquette
- Modification du champ checkbox pour le type de tarif (Demi-journée / Journée)
- Création de l'entité **Reservation** directement depuis PHPStorm

_______________________________________________________

## 3eme Commit : Création entité Detail Reservation & Creation des tables

Ce commit comprend :
- Création de l'entité **DetailReservation** directement depuis PHPStorm.
- Création de la **liaison ManyToOne** entre **DetailReservation** et **Reservation**
- Mise à jour des getters et setters de l'entité **DetailReservation**
- Mise à jour de la base de données
- Suppression du Bundle de démonstration AppBundle

______________________________________________________

## 4eme Commit : Installation du composant Stripe pour Symfony

Ce commit comprend :
- Ajout dans composer.json de la ligne **"stripe/stripe-php":"4.*"**
- Composer update pour installer le composant stripe
- Création d'un controleur spécifique **OrderController.php**
- Création d'une vue pour le order : **prepare.html.twig**
- Ajout des 2 nouvelles **routes prepare** et **checkout** de **OrderController**

______________________________________________________

## 5eme Commit : Refonte du site avec le theme Cerulean Bootswatch et intégration du sous formulaire detailReservation

Ce commit comprend :
- Création de l'entité Pays qui contiendra la liste complete des pays du monde : **Pays.php**
- Ajustement du formulaire **Booking** avec les éléments de l'entité **Reservation**.
- Insertion du Sous Formulaire Detail Réservation pour les infos liées au Réservant
- Création du fichier **mydatepicker.js**.
- Simplification du formulaire **DetailReservationType** au niveau de la date de naissance (**BirthdayType**).
- Enregistrement dans la base : OK
- Génération du code réservation aléatoire : OK
- Récapitulatif transmis sur la plage prepare.html.twig : OK

______________________________________________________

## 6eme Commit : Commit Temporaire avec le sous formulaire qui n'enregistre pas

Ce commit comprend :
- Récupération du nom pays dans la vue Récapitulative
- Création du formulaire d'ajout d'une nombre de personnes

______________________________________________________

## 7eme Commit : Correction de la liaison Reservation-DetailReservation + Amélioration du sous-formulaire

Ce commit comprend :
- Refonte des entitées **Reservation** et **DetailReservation**
- Ajout de la liaison **ManyToOne** entre ces 2 entitées
- Mise en place du test sur la **date et le type de réservation** (**si datedujour et >14h alors Demi-Journée**)
- Mise en place du test sur le **nombre de places demandées** afin d'afficher le nombre de sous formulaire adéquat
- Création du fichier **mydetail.js** contenant le code pour afficher le nombre de sous formulaire.
- choix du nombres de places et affichage du nombre de sous-formulaire adéquat : OK
- Enregistrement multi-Visiteurs : OK
- Petit Bug au niveau du test du type de réservation (Pour l'instant, j'ai désactivé le disabled pour éviter un exception au niveau de Symfony)

______________________________________________________

## 8eme Commit : Gestion des Tarifs et du Tarif Réduit

Ce commit comprend :
- Amélioration du rendu des **tarifs coté gauche**
- Mise à jour de la vue **visiteurs.html.twig**
- Mise en parametre du nombre max de billet par jour app/config/parameters.yml
- Création d'une class services **BookingBundle/Services/Traitements** qui contient : **Calcul des tarifs**.
- Configuration du service dans le fichier **BookingBundle/Resources/config/services.yml** sous le nom : **Louvre_Booking.Traitements**

_____________________________________________________

## 9eme Commit : Nettoyage du code et des fichiers inutiles / Installation de CoreSphereConsole

Ce commit comprend :
- Installation de **CoreSphereConsole** pour pouvoir utiliser la console directement depuis le web
- Ajout dans le fichier **app_kernel.php** le bundle coreSphere
- Ajout d'une route dans le fichier r**outing_dev.yml** du répertoire **app/config**.
- Nettoyage des fichiers inutiles ou non utilisés (code, css, js, php).
_____________________________________________________

## 10eme Commit : Gestion du paiement par le module Stripe

Ce commit comprend :
- Ajout des champs Montant et idRes "hidden" dans le formulaire prepare.html.twig afin de pouvoir récupérer le montant et l'identifiant de la transaction
- Ajout d'un champ valided dans l'entité Reservation afin d'indiquer la bonne validation de la réservation apres paiement par Stripe
- Modification de la vue de préparation du paiement **prepare.html.twig**
- Modification de la vue de validation du paiement **valided.html.twig**
---
Modif Annexe : 
- Modification du fichier mydetails.js afin que le changement du nombre de places se fassent sans attendre le clic de l'utilisateur

_____________________________________________________

## 11eme Commit : Gestion de l'envoi de l'email

Ce commit comprend :
- Parametrage du bundle swiftmailer dans les ficheirs app/config/config.yml et parameters.yml
- Ajout des lignes de code permettant le parametrage du mail et l'envoi du mail
- Création d'une vue dédiée au contenu de l'email : **mail.html.twig**
- Test d'envoi Ok
- Scénario du retour à la page d'accueil automatique
- Correction du fichier mydetail.js au niveau de la gestion du type de réservation en fonction de l'heure de la date de visite
_____________________________________________________

## 12eme Commit : Gestion du nombre de places Max à vendre par jour

Ce commit comprend :
- Création d'un **controleur API** pour gérer le nombre de places restant pour un jour donné
- Création d'une **methode** dans le **Repository Reservation** retournant le nombre de places pour un jour donné
- Création d'une Constante **BILLET_MAX** dans l'entité **Réservation**.
- Test fonctionnel : OK
- Modification de la vue **Booking.html.twig** pour insérer une alerte (fenetre modale) si le nombre de places sélectionné est trop important par rapport au nombre de places Max restant
- Modification du fchier **mydetail.js** afin d'integrer l'appel AJAX et la fenetre modale pour l'alerte

_____________________________________________________

## 13eme Commit : Gestion des Tests Unitaires et Fonctionnels

Ce commit comprend :
- Ajout du composant phpunit 5.6 dans notre fichier composer.json
- Création dans le répertoire **Projet4/Tests** d'un **dossier Entity** pour effectuer les **tests unitaires** pour les entitées **Reservation** et **DetailReservation**.
- Création dans le répertoire **Projet4/Tests** d'un **dossier Controller** pour effectuer les **tests fonctionnels** pour les controllers de mon projet.
- Test Execution dans console OK 10/10 assertions 

_____________________________________________________

## 14eme Commit : Personnalisation des pages d'erreur

Ce commit comprend :
- Remplacement des pages d'erreur **error.html.twig** de Twig Bundle dans le dossier  **App/Resources/TwigBundle/views/Exception**
- Ajout des vues **error404.html.twig** et **error500.html.twig** pour les pages non trouvées

_____________________________________________________

## 15eme Commit : 1er Recettage

Ce commit comprend :
- Modification du fichier **app_dev.php** afin qu'il accepte mon adresse IP sur le serveur de production.
- Modification du fichier **mydetail.js** pour ajouter la vérification numérique des valeurs pour le test du nombre de place dispo.
- Ajout suite oubli de la date du 1er Mai comme étant férié. (fichier **mydatepicker.js**)
- Modification du test fonctionnel de **BookingControllerTest.php**
- Suppression du Bundle CoreSphereBundle qui est inutile avec mon VPS
