$(document).ready(function(){

    // // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
    // var $container = $('div#louvre_bookingbundle_reservation_detailResa');
    // console.log($container);
    // var $nbrePlaces = $("select#louvre_bookingbundle_reservation_nbrePlaces");
    // var index = $nbrePlaces.val();
    // console.log('valeur de index : ' + index);
    // console.log($nbrePlaces);
    //
    // // Ajout X fois les informations à demander en fonction du nombre de personnes
    // $nbrePlaces.on('change', function(){
    //     console.log('je passe la');
    //     var index = $("#louvre_bookingbundle_reservation_nbrePlaces").val();
    //     console.log('valeur de index : ' + index);
    //     var boxes = $("#boxes");
    //     $container.empty();
    //     for (i = 0; i < index; i++ ) {
    //         addVisiteur($container, i);
    //     }
    // });
    // function addVisiteur($container, $indice) {
    //     // Dans le contenu de l'attribut « data-prototype », on remplace :
    //     // - le texte "__name__label__" qu'il contient par le label du champ
    //     // - le texte "__name__" qu'il contient par le numéro du champ
    //     var template = $container.attr('data-prototype')
    //         .replace(/__name__label__/g, 'Visiteur n°' + Number($indice +1))
    //         .replace(/__name__/g,        $indice)
    //     ;
    //     // On crée un objet jquery qui contient ce template
    //     var $prototype = $(template);
    //     console.log($prototype);
    //     // On ajoute le prototype modifié à la fin de la balise <div>
    //     $container.append($prototype);
    // }



    // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
    var $container = $('div#louvre_bookingbundle_reservation_detailResa');

    // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
    var index = $container.find(':input').length;

    // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
    $('#add_visitor').click(function(e) {
        addVisitor($container);

        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        return false;
    });

    // On ajoute un premier champ automatiquement s'il n'en existe pas déjà un (cas d'une nouvelle annonce par exemple).
    if (index == 0) {
        addVisitor($container);
    } else {
        // S'il existe déjà des visiteurs, on ajoute un lien de suppression pour chacune d'entre elles
        $container.children('div').each(function() {
            addDeleteVisitor($(this));
        });
    }

    // La fonction qui ajoute un formulaire CategoryType
    function addVisitor($container) {
        // Dans le contenu de l'attribut « data-prototype », on remplace :
        // - le texte "__name__label__" qu'il contient par le label du champ
        // - le texte "__name__" qu'il contient par le numéro du champ
        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, 'Visiteur n°' + (index+1))
            .replace(/__name__/g,        index)
        ;

        // On crée un objet jquery qui contient ce template
        var $prototype = $(template);

        // On ajoute le prototype modifié à la fin de la balise <div>
        $container.append($prototype);

        // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
        index++;
    }

    // Active le bouton Valider si l'adresse email est renseignée
    $('#louvre_bookingbundle_reservation_emailClient').blur(function() {
        if ( $(this).val() != "" ){
            $('#valid').removeClass('disabled');
        }
    });
});