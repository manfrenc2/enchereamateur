<?php
// Initialisation de la session.
// Si vous utilisez un autre nom
// session_name("autrenom")
session_start();


// Si vous voulez détruire complètement la session, effacez également
// le cookie de session.
// Note : cela détruira la session et pas seulement les données de session !
unset($_COOKIE); // Destruction des cookies
session_destroy();


header("location: ../index.php?");
?>