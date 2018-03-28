
$(document).ready(function() {
    
    $("div.event").each(function(i){
        // find permet d appliquer un sélecteur sur un ensemble selectionné
        $(this).find(".event-description").attr("id","event-description"+(i+1)).hide();
        $(this).find("a.afficherconcert").attr("id","afficherconcert"+(i+1)).html("Afficher plus").attr("statut","1").click(
        function(){
            $("#event-description"+(i+1)).toggle();
            // selon le statut on renomme le texte
            if ($("#afficherconcert"+(i+1)).attr("statut")=="1"){
                $("#afficherconcert"+(i+1)).html("Masquer").attr("statut","0");
            }
            else{
                $("#afficherconcert"+(i+1)).html("Afficher plus").attr("statut","1");
            };
        })
    });
});


