<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorCuestionario.php");

    SessionManager::validateUserInPage("menu_admin.php");

    $pagina = file_get_contents("Templates/InsertarCuestionario.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Insertar Cuestionario", $pagina);

    //Create the button
    $saveButton = '<button type="button" class="btn btn-warning" onclick=\'validateData("curso_insertar.php", "insert")\'>
                      <img src="icons/saveLight.png" height="50px"><br>
                      <strong>Guardar</strong>
                   </button>';

    $cancelButton = '<button type="button" class="btn btn-warning" onclick=\'href("curso_menu.php")\'>
                        <img src="icons/deleteLight.png" height="50px"><br>
                        <strong>Cancelar</strong>
                    </button>';

    $returnButton = '';

    //Create a action for button cancel
    $pagina = str_replace("|SaveButton|"  , $saveButton  , $pagina);
    $pagina = str_replace("|CancelButton|", $cancelButton, $pagina);
    $pagina = str_replace("|ReturnButton|", $returnButton, $pagina);
    $pagina = str_replace("|Alumnos|", "", $pagina);
    $pagina = str_replace("disabled", '', $pagina);


    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    echo $pagina;


 ?>