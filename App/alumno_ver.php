<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorAlumno.php");

    SessionManager::validateUserInPage("menu_admin.php");

    if (!array_key_exists("id", $_GET))
    {
        echo "<script>window.location.href='alumno_menu.php'</script>";
    }

    $pagina = file_get_contents("Templates/InsertarAlumno.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Ver Alumno", $pagina);

    //Create the button
    $saveButton = '';

    $cancelButton = '<button type="button" class="btn btn-info" onclick=\'href("alumno_menu.php")\'>
                        <img src="icons/returnLight.png" height="50px"><br>
                        <strong>Regresar</strong>
                    </button>';

    $returnButton = '';

    //Create a action for button cancel
    $pagina = str_replace("|SaveButton|"  , $saveButton  , $pagina);
    $pagina = str_replace("|CancelButton|", $cancelButton, $pagina);
    $pagina = str_replace("|ReturnButton|", $returnButton, $pagina);

    //Obtenemos y ponemos los datos del registro
    $obj = ControladorAlumno::getSingle(array('id' => trim($_GET["id"])));

    $script .= "<script>
                    $('#idAlumno').html('".trim($_GET["id"])."');

                    $('#txtCodigo').val(".json_encode(trim($obj->getPassword())).");
                    $('#txtNombres').val(".json_encode(trim($obj->getNombres())).");
                    $('#txtApellidoPaterno').val(".json_encode(trim($obj->getApellidoPaterno())).");
                    $('#txtApellidoMaterno').val(".json_encode(trim($obj->getApellidoMaterno())).");
                    $('#selectTipo').val(".json_encode(trim($obj->getTipo())).");
                </script>";

    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    echo $pagina;
    echo $script;


 ?>