<?php
$lien_billetterie = "https://collecte.io/test-billeterie-59423"
?>

<iframe 
    height="700"
    width="100%"
    style="border:none;"
    <?php
    echo "src=$lien_billetterie>";
    
    // Texte affiché sur les navigateurs ne supportant pas l'IFrame
    echo "Voici le lien vers la billetterie : <a href=$lien_billetterie>https://collecte.io/test-billeterie-59423</a>";
    ?>
</iframe>