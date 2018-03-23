
$(document).ready(function() {
    
    $("div.concert").each(function(i){
        // find permet d appliquer un sélecteur sur un ensemble selectionné
        $(this).find(".description").attr("id","description"+(i+1)).hide();
        $(this).find("a.afficherconcert").attr("id","afficherconcert"+(i+1)).html("Afficher").attr("statut","1").click(
        function(){
            $("#description"+(i+1)).toggle();
            // selon le statut on renomme le texte
            if ($("#afficherconcert"+(i+1)).attr("statut")=="1"){
                $("#afficherconcert"+(i+1)).html("Masquer").attr("statut","0");
            }
            else{
                $("#afficherconcert"+(i+1)).html("Afficher").attr("statut","1");
            };
        })
    });
});


