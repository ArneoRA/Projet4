$(document).ready(function(){
    // //////////// Verrouillage du champ Type de réservation en fonction de la date de visite choisie /////////////////
    $('#louvre_bookingbundle_reservation_dateVisite').blur(function(){
        var $datevisite = $('#louvre_bookingbundle_reservation_dateVisite').val();
        moment.locale('fr');
        var dateA = moment().format('L');
        var dt = new Date();
        var heure = dt.getHours();
        if ( $datevisite == dateA){
            if (heure >= 14){
                $('#louvre_bookingbundle_reservation_typeReservation').val(0);
                $('#louvre_bookingbundle_reservation_typeReservation').attr('disabled', true);
            } else
            {
                $('#louvre_bookingbundle_reservation_typeReservation').val(1);
                $('#louvre_bookingbundle_reservation_typeReservation').attr('disabled', false);
            }
        } else
        {
            $('#louvre_bookingbundle_reservation_typeReservation').attr('disabled', false);
        }

        // ///////////////// APPEL AJAX POUR RECUPERE NBRE DE PLACES DISPO POUR LE JOUR SELECTIONNE ///////////////
        var dateV = $datevisite.split("/");
        var dateA =dateV[2]+"-"+dateV[1]+"-"+dateV[0];
        $.ajax({
            type: 'get',
            format: 'json',
            url: 'api/' + dateA,
            success: function(data){
                $("#nbplace").text(data);
                $("#nbplaceM").text(data);
            }
        });
    });


    // ////////////////////////////// AJOUT D'AU MOINS 1 SOUS-FORMULAIRE PAR DEFAUT ///////////////////////////////////
    // On récupère la balise <div> qui contient l'attribut « data-prototype »
    var $container = $('div#louvre_bookingbundle_reservation_details');
    if (document.getElementById('louvre_bookingbundle_reservation_details')){
        // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
        var index = $container.find(':input').length;
        // On ajoute un premier champ automatiquement.
        if (index == 0) {
            addDetail($container);
        }
    }

    // /////////////////////////// AJOUT DES SOUS-FORMULAIRES NECESSAIRES ////////////////////////////////
    // ********* RECUPERATION DES VARIABLES
    var index = $container.find(':input').length;
    var $nbrePlaces = $("#louvre_bookingbundle_reservation_nbrePlaces");
    // ********* SUR CHANGEMENT Nbre de Places
    $nbrePlaces.on('change', function(e){
        e.preventDefault();
        var placeMax = $("#nbplace").text();
        if (parseInt($nbrePlaces.val()) > parseInt(placeMax)) {
            $('#myAlert').modal('show');
        } else {
            var indice = $("#louvre_bookingbundle_reservation_nbrePlaces").val()-1;
            $container.empty();
            index = 0
            for (i = 0; i <= indice; i++ ) {
                addDetail($container);
            }
        }

    });

    // /////////////////////// FONCTION addDetail ///////////////////////
    function addDetail($container) {
        // Dans le contenu de l'attribut « data-prototype », on remplace
        // - le texte "__name__label__" qu'il contient par le label du champ
        // - le texte "__name__" qu'il contient par le numéro du champ
        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, 'Visiteur n°' + (index+1))
            .replace(/__name__/g,        index)
        ;
        // On crée un objet jquery qui contient ce template
        var $prototype = $(template);
        // Augmente l'index de 1 pour l'élément suivant
        $container.data('index', index + 1);
        // On ajoute le prototype modifié à la fin de la balise <div>
        $container.append($prototype);
        // Ajustement des champs du formulaire afin qu'ils tiennent tous sur une ligne (BootStrap)
        $('#louvre_bookingbundle_reservation_details_' + index).children().removeClass('form-group').addClass('col-md-2');
        $('#louvre_bookingbundle_reservation_details_' + index).find('div:nth-child(4)').removeClass('col-md-2').addClass('col-md-3');
        $('#louvre_bookingbundle_reservation_details_' + index).find('div:last').removeClass('col-md-2').addClass('col-md-1');
        // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
        index++;
    }

    // /////////////////  VALIDATION DES CHAMPS OBLIGATOIRES Nom & Prenom ////////////////////
    $('#louvre_bookingbundle_reservation_Valider').on('click', function(e){
        e.preventDefault();
        var indice = $("#louvre_bookingbundle_reservation_nbrePlaces").val()-1;
        // Vérification des champs obligatoires Nom & Prenom sur l'ensemble du sous-formulaire
        for (i = 0; i <= indice; i++ ) {
            // Récupération des élèments nécessaires
            var nomV = $('#louvre_bookingbundle_reservation_details_' + i + '_nomVisiteur');
            var prenomV = $('#louvre_bookingbundle_reservation_details_' + i + '_prenomVisiteur');
            // Suppression de la class 'has-error' au niveau parent
            nomV.parent().removeClass('has-error');
            prenomV.parent().removeClass('has-error');
            // Test sur le contenu du Nom
            if (nomV.val() == ""){
                // Ajout de la class has-error pour indiquer à l'utilisateur quel champ n'est pas valide
                nomV.parent().addClass('has-error');
                prenomV.parent().removeClass('has-error');
                nomV.attr("placeholder", "Nom Obligatoire");
                // Bloque l'envoi du formulaire
                return false;
            // Test sur le contenu du Prenom
            } else if (prenomV.val() ==""){
                // Ajout de la class has-error pour indiquer à l'utilisateur quel champ n'est pas valide
                prenomV.parent().addClass('has-error');
                nomV.parent().removeClass('has-error');
                prenomV.attr("placeholder", "Prenom Obligatoire");
                // Bloque l'envoi du formulaire
                return false;
            }
        }
        // Si tout est OK activation du champ type de réservation et soumission du formulaire
        $('#louvre_bookingbundle_reservation_typeReservation').attr('disabled', false);
        $(this).parents('form').submit()
    });

    // Active le bouton Valider si l'adresse email est renseignée
    $('#louvre_bookingbundle_reservation_emailClient').on('blur',function(e) {
        e.preventDefault();
        if ( $(this).val() != "" ){
            $('#louvre_bookingbundle_reservation_Valider').show();
            return true;
        }
    });

    // Affichage des tarifications sur les petits smartphones
    $('#reserBillet').on('click', function(e){
        e.preventDefault();
        $('#myInfo').modal('show');
    });



});