$(document).ready(function(){

    $('a.product_add').on('click', function(e){
        e.preventDefault();
        var collectionHolder = $('#louvre_bookingbundle_reservation_details');
        console.log(collectionHolder);
        var prototype = collectionHolder.attr('data-prototype');
        form = prototype.replace(/__name__/g, collectionHolder.children().length);
        collectionHolder.append(form);
    });


    // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
    var $container = $('div.visiteurs');
    console.log($container);
    var $nbrePlaces = $("select#louvre_bookingbundle_reservation_nbrePlaces");
    console.log($nbrePlaces);
    var index = $nbrePlaces.val();
    console.log('valeur de index : ' + index);

    // Ajout X fois les informations à demander en fonction du nombre de personnes
    $nbrePlaces.on('blur', function(e){
        e.preventDefault();
        var index = $nbrePlaces.val()-1;
        console.log('nouvelle valeur de index : ' + index);
        $container.empty();
        for (i = 0; i <= index; i++ ) {
            addVisiteur($container, i);
            console.log('valeur de i : ' +i);
        }
    });
    function addVisiteur($container, $indice) {

        // Get the data-prototype explained earlier
        var prototype = $container.data('prototype');
        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, $indice);
        // increase the index with one for the next item
        $container.data('index', index + 1);
        // On crée un objet jquery qui contient ce template
        var $newFormLi = $('<div></div>').append(newForm);
        // On ajoute le $newFormLi à la fin de la balise <ul>
        $container.append($newFormLi);
    }


    // Active le bouton Valider si l'adresse email est renseignée
    $('#louvre_bookingbundle_reservation_emailClient').blur(function() {
        if ( $(this).val() != "" ){
            $('#valid').removeClass('disabled');
        }
    });
});