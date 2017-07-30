$(document).ready(function(){
    // //////////// Verrouillage du champ Type de réservation en fonction de la date de visite choisie /////////////////
    $('#louvre_bookingbundle_reservation_dateVisite').blur(function(){
            // *********** date de visite souhaitée **********************
        var $datevisite = $('#louvre_bookingbundle_reservation_dateVisite').val();
        // console.log('Valeur de date de visite : ' + $datevisite);
            // *********** date du jour pour la comparaison **********************
        moment.locale('fr');
        var dateA = moment().format('L');
        // console.log('Valeur de la date actuelle : ' + dateA);
            // *********** heure du jour pour tester le "A partir de 14h" **********************
        var dt = new Date();
        var heure = dt.getHours();
        // console.log('Heure actuelle : ' + heure);
        if ( $datevisite == dateA){
            if (heure >= 9){
                // console.log(heure);
                // console.log($datevisite);
                $('#louvre_bookingbundle_reservation_typeReservation').val(0);
                // $('#louvre_bookingbundle_reservation_typeReservation').attr('readonly', true);
            } else
            {
                // console.log('heure inférieure à 10 : ' + heure);
                // console.log($datevisite);
                $('#louvre_bookingbundle_reservation_typeReservation').val(1);
                // $('#louvre_bookingbundle_reservation_typeReservation').attr('readonly', false);
            }
        } else
        {
            $('#louvre_bookingbundle_reservation_typeReservation').attr('readonly', false);
        }
    });

    // ////////////////////////////// AJOUT D'AU MOINS 1 SOUS-FORMULAIRE ///////////////////////////////////
    // On récupère la balise <div> qui contient l'attribut « data-prototype »
    var $container = $('div#louvre_bookingbundle_reservation_details');
    // console.log($container);
    // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
    var index = $container.find(':input').length;
    // console.log(index);
    // On ajoute un premier champ automatiquement.
    if (index == 0) {
        addDetail($container);
    }

    // ////////////////////////////// AJOUT D'AU MOINS 1 SOUS-FORMULAIRE ///////////////////////////////////
    // ********* RECUPERATION DES VARIABLES
    var index = $container.find(':input').length;
    var $nbrePlaces = $("#louvre_bookingbundle_reservation_nbrePlaces");
    // console.log($nbrePlaces);
    var indice = $nbrePlaces.val();
    // console.log('valeur de indice : ' + indice);
    // ********* SUR PERTE DU FOCUS Nbre de Palces
    $nbrePlaces.on('blur', function(e){
        e.preventDefault();
        var indice = $("#louvre_bookingbundle_reservation_nbrePlaces").val()-1;
        $container.empty();
        index = 0
        for (i = 0; i <= indice; i++ ) {
            addDetail($container);
            console.log('valeur de i : ' +i);
        }
    });

    // /////////////////////// FONCTION QUI AJOUTE UN SOUS-FORMULAIRE DetailRservationType ///////////////////////
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
        // console.log($prototype);
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

    // Active le bouton Valider si l'adresse email est renseignée
    $('#louvre_bookingbundle_reservation_emailClient').blur(function() {
        if ( $(this).val() != "" ){
            $('#louvre_bookingbundle_reservation_Valider').show();
        }
    });

    // FONCTION NON UTILISEE
    // $('#louvre_bookingbundle_reservation_details_0_dateNaissance_year').blur(function(){
    //     var annee = $('#louvre_bookingbundle_reservation_details_0_dateNaissance_year').val();
    //     var mois = $('#louvre_bookingbundle_reservation_details_0_dateNaissance_month').val() <10 ?
    //         '0'+ $('#louvre_bookingbundle_reservation_details_0_dateNaissance_month').val()
    //         : $('#louvre_bookingbundle_reservation_details_0_dateNaissance_month').val();
    //     var jour = $('#louvre_bookingbundle_reservation_details_0_dateNaissance_day').val() <10 ?
    //         '0'+ $('#louvre_bookingbundle_reservation_details_0_dateNaissance_day').val()
    //         : $('#louvre_bookingbundle_reservation_details_0_dateNaissance_day').val();
    //     var dateN = jour +'/'+ mois +'/'+ annee;
    //     var dateE = new Date(dateN).getTime();
    //     console.log ('Valeur de Date de Naissance : ' + dateE);
    //     $.ajax({
    //         type: 'get',
    //         format: 'json',
    //         url: 'http://localhost/Projet4/web/app_dev.php/subform/' + dateE,
    //         beforeSend: function(){
    //             console.log('Ca charge');
    //         },
    //         success: function(){
    //             console.log ('Ca vient Tkt');
    //             // $("#louvre_bookingbundle_reservation_details_0_tarifvisiteur").val(data[1]);
    //
    //         }
    //     });
    // });

});