$(function() {
    // Initialisation des variables nécessaires au traitement
    var disDates =[];
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
});