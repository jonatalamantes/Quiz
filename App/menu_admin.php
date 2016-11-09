<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorAlumno.php");

    SessionManager::validateUserInPage("menu_admin.php");

    $pagina = file_get_contents("Templates/MenuAdmin.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Menú Principal", $pagina);



    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    echo $pagina;


 ?>