<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorCurso.php");

    SessionManager::validateUserInPage("menu_admin.php");

    if (!array_key_exists("id", $_GET))
    {
        echo "<script>window.location.href='curso_menu.php'</script>";
    }

    $pagina = file_get_contents("Templates/InsertarCurso.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Editar Curso", $pagina);

    //Create the button
    $saveButton = '<button type="button" class="btn btn-info" onclick=\'validateData("curso_insertar.php", "update")\'>
                      <img src="icons/saveLight.png" height="50px"><br>
                      <strong>Guardar</strong>
                   </button>';

    $cancelButton = '<button type="button" class="btn btn-info" onclick=\'href("curso_menu.php")\'>
                        <img src="icons/deleteLight.png" height="50px"><br>
                        <strong>Cancelar</strong>
                    </button>';

    $returnButton = '';

    //Create a action for button cancel
    $pagina = str_replace("|SaveButton|"  , $saveButton  , $pagina);
    $pagina = str_replace("|CancelButton|", $cancelButton, $pagina);
    $pagina = str_replace("|ReturnButton|", $returnButton, $pagina);
    $pagina = str_replace("disabled", '', $pagina);

    //Obtenemos y ponemos los datos del registro
    $obj = ControladorCurso::getSingle(array('id' => trim($_GET["id"])));

    $script .= "<script>
                    $('#idCurso').html('".trim($_GET["id"])."');

                    $('#txtCiclo').val(".json_encode(trim($obj->getCiclo())).");
                    $('#txtNombre').val(".json_encode(trim($obj->getNombre())).");
                </script>";

    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    echo $pagina;
    echo $script;


 ?>