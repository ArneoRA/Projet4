$(function() {

    // Initialisation du DatePicker
    $('#louvre_bookingbundle_reservation_dateVisite').datetimepicker({
        locale: 'fr',
        format: 'L',
        minDate: moment().add(-1,'days'),
        // monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        // weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        // today: 'Aujourd\'hui',
        // clear: 'Effacer',
        disabledDates: [
            new Date(2017, 10, 1), // Désactive le 01/11/2017 (il faut le faire sur le mois précédent vu Doc Datepicker.js)
            new Date(2017, 11, 25) // Désactive le 25/12/2017
        ],
        daysOfWeekDisabled: [2], // Désactive tous les mardis du calendrier
    });



});