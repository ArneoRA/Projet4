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

_____________________________________________________

## 16eme Commit : 2eme Recettage - Correction Requete

Ce commit comprend :
- Installation du Bundle Assetic
- Suite Bug Cours Symfony OC, Désinstallation du Bundle Assetic
- Vérification que le fichier app_dev.php et app.php soient accessibles
- Correction de la requete **placeJours($date)** pour qu'elle somme correctement le nbre de places par date

_____________________________________________________

## 17eme Commit : Ameliorations et Gestion des dates avec Billet Max atteint

Ce commit comprend :
- Insertion du logo du Louvre dans la NavBar
- Ajustement visuel du sous formulaire Visiteur
- Modification de l'encart de gauche (Suppression du logo et du titre H5)
- Ajustement de la partie Responsive (Traitement de l'encart de gauche et du logo de la Navbar)
- Basculement de l'enregistrement du détails de la réservation sous forme de service (**Services/Traitements.php**).
- Récupération **dynamique des dates à désactiver** pour le champ Date de Visite
- Modification du fichier **mydatepicker.js** afin de prendre en compte l'appel AJAX nécessaire pour la récupération dynamique des dates à désactiver
- Ajout d'une méthode dans **ReservationRepository.php** pour récupérer les dates à désactiver. 
- Ajout d'une méthode dans ApiController.php (**datesNoDispoAction()**) permettant l'envoi des dates à désactiver
_____________________________________________________

## 18eme Commit : Dernier Recettage en date du 11-08-2017

Ce commit comprend :
- Choix **par défaut du Pays 'FRANCE'** / 'FR' dans le fichier **DetailReservationType.php**
- Modification du range de l'année pour le champ **Date de Naissance** (Début = 1920) dans le fichier **DetailReservationType.php**

_____________________________________________________

## 19eme Commit : Ajustements SensioLabs + Bootstrap

Ce commit comprend :
- Déplacement d'un flush dans le fichier **Traitements.php**
- Typage des variables **$em** et **$resa** de la méthode **setdetailVisiteurs()**
- Inscription du fichier **config.php** dans le fichier **.gitignore** 
- Intégration dans les tests PHPUnit du fichier **Services/TraitementsTest.php**
- Ajustement du footer pour les petits smartphones : **layout.html.twig**
- Ajustement de la bulle info pour les petits écrans : **projet4.css / layout.html.twig / mydetails.js / booking.html.twig**
- Modification de OrderController.php pour ne plus utiliser **$_POST** mais **$request**
- Ajout d'une info **server_version: 5.6** dans le bloc **DBAL** dans le fichier **app/config/config.yml**
- Basculement des formulaires dans le répertoire **Form/Type**
- Mise en commentaire des 2 variables non utilisées dans le répertoire DependencyInjection

_____________________________________________________

## 20eme Commit : Ajustements SensioLabs 2eme passe

Ce commit comprend :
- Suppression du fichier config.php du répertoire web
- Suppression de Request::createFromGlobals(); dans le fichier OrderController.php
- Composer update pour basculer sur la version 3.3.8 de Symfony
- Modification du nom de session dans le fichier app/config.php
- Modification du code secret Symfony dans le fichier parameters.yml
- Suppression dans le fichier .gitignore de la ligne : /app/config/parameters.yml

_____________________________________________________

## 21eme Commit : Ajustements SensioLabs 3eme passe

Ce commit comprend :
- Rectification du code secret dans le fichier parameters.yml pour le modifier dans le fichier parameters.yml.dist
- Modification du fichier .gitignore en remettant la ligne : /app/config/parameters.yml

_____________________________________________________

## 22eme Commit : Ajustements SensioLabs 4eme passe

Ce commit comprend :
- Modification du fichier **Resources/services.yml** afin d'ajouter Doctrine/EntityManager en parametre.
- Modification du fichier **Services/Traitements.php** afin d'ajouter EntityManager dans le constructeur.
- Modification de la méthode **setdetailVisiteurs()** en retirant le parametre $em.
- Modification du fichier de la méthode **bookingAction()** de **BookingController.php** en retirant le parametre $em.

_____________________________________________________

## 23eme Commit : Recettage et ajout des Mentions légales

Ce commit comprend :
- Ajout de la route **louvre_booking_mentions** dans le fichier **routing.yml**
- Ajout d'une page Mentions légales générées via le site www.generer-mentions-legales.com : **Mentions/mentions.html.twig**
- Modification du menu principal
- Modification des fichiers d'erreur
- Ajout de la nouvelle route dans le test fonctionnel

_____________________________________________________

## 24eme Commit : Derniers ajustements suite session Mentoring du 04-09-2017

Ce commit comprend :
- Modification texte d'accompagnement types de tarifs
- Correction d'un message d'erreur JS dans la console : fichiers **mydetail.js** & **mydatepicker.js**
- Correction du tableau des tarifs (Probleme de responsivité)
- Ajout d'une page simple "Nous contacter" qui pourra être remplacer par un formulaire plus complet dans le cadre de la création d'un BackEnd.
- Ajout du test fonctionnel associé à la page contact
- Ajout des contraintes par Annotation dans les entités **Reservation** et **DetailReservation**
- Ajout du test sur les champs **Nom et Prenom du Sous-formulaire** : fichier **mydetails.js**
- Ajustement de l'ensemble des views