<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorCuestionario.php");

    SessionManager::validateUserInPage("menu_admin.php");

    $pagina = file_get_contents("Templates/MenuCuestionario.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Menú de Cuestionarios", $pagina);



    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    echo $pagina;


 ?>