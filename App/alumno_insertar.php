<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorAlumno.php");

    SessionManager::validateUserInPage("menu_admin.php");

    $pagina = file_get_contents("Templates/InsertarAlumno.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "insertar Alumno", $pagina);

    //Create the button
    $saveButton = '<button type="button" class="btn btn-info" onclick=\'validateData("alumno_insertar.php", "insert")\'>
                      <img src="icons/saveLight.png" height="50px"><br>
                      <strong>Guardar</strong>
                   </button>';

    $cancelButton = '<button type="button" class="btn btn-info" onclick=\'href("alumno_menu.php")\'>
                        <img src="icons/deleteLight.png" height="50px"><br>
                        <strong>Cancelar</strong>
                    </button>';

    $returnButton = '';

    //Create a action for button cancel
    $pagina = str_replace("|SaveButton|"  , $saveButton  , $pagina);
    $pagina = str_replace("|CancelButton|", $cancelButton, $pagina);
    $pagina = str_replace("|ReturnButton|", $returnButton, $pagina);
    $pagina = str_replace("|Cursos|", "", $pagina);
    $pagina = str_replace("disabled", '', $pagina);
    
    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    echo $pagina;


 ?>