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
