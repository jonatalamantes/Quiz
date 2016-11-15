<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorCurso.php");

    SessionManager::validateUserInPage("menu_admin.php");

    $pagina = file_get_contents("Templates/MenuCurso.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Menú de Cursos", $pagina);

    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    echo $pagina;


 ?>