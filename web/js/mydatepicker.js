$(function() {
    // Initialisation des variables nécessaires au traitement
    var disDates =[];
    var $datevisite = $('#louvre_bookingbundle_reservation_dateVisite').val();

    // Test de présence de l'identifiant dateVisite
    if (document.getElementById('louvre_bookingbundle_reservation_dateVisite')){
        // Execution de l'appel AJAX pour récupérer les dates à désactiver
        $.ajax({
            type: 'get',
            data: 'json',
            url: 'api_exclu',
            success: function(data){
                // Récupération des dates et ajout dans le tableau disDates
                $.each(data, function(key, val){
                    // On transforme le timestamp en date au format Y-MM-DD et on l'ajoute à notre tableau de dates disDates
                    disDates.push(moment.unix(val).format('Y-MM-DD'));
                });
                // Initialisation du DatePicker avec la variable disDates pour l'option disabledDates
                $('#louvre_bookingbundle_reservation_dateVisite').datetimepicker({
                    locale: 'fr',
                    format: 'L',
                    minDate: moment().add(-1,'days'),
                    disabledDates: disDates,
                    daysOfWeekDisabled: [2] // Désactive tous les mardis du calendrier
                });
            }
        });
        // //////////// Verrouillage du champ Type de réservation en fonction de la date de visite choisie /////////////////
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
    }

});