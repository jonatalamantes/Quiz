<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorCuestionario.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorRelacionCuestionarioCurso.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorCurso.php");

    SessionManager::validateUserInPage("menu_admin.php");

    if (!array_key_exists("idCuestionario", $_GET) && !array_key_exists("idCurso", $_GET))
    {
        echo "<script>window.location.href='menu_admin.php'</script>";
    }

    $pagina = file_get_contents("Templates/InsertarRelacionBinaria.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Insertar Relacion Cuestionario Curso", $pagina);

    $pagina = str_replace("|Obj1|", "Cuestionario", $pagina);
    $pagina = str_replace("|Obj2|", "Curso", $pagina);

    //Create the button
    $saveButton = '<button type="button" class="btn btn-info" onclick=\'validateData("agregar_cuestionario_curso.php", "'.SessionManager::getLastPage().'")\'>
                      <img src="icons/saveLight.png" height="50px"><br>
                      <strong>Guardar</strong>
                   </button>';

    $cancelButton = '<button type="button" class="btn btn-success" onclick=\'href("'.SessionManager::getLastPage().'")\'>
                      <img src="icons/returnLight.png" height="50px"><br>
                      <strong>Regresar</strong>
                   </button>';

    $returnButton = '';

    //Create a action for button cancel
    $pagina = str_replace("|SaveButton|"  , $saveButton  , $pagina);
    $pagina = str_replace("|CancelButton|", $cancelButton, $pagina);
    $pagina = str_replace("|ReturnButton|", $returnButton, $pagina);

    $script = "<script>";

    if (array_key_exists("idCurso", $_GET))
    {
        $curso = ControladorCurso::getSingle(array('id' => $_GET["idCurso"]));

        if ($curso !== NULL)
        {
            $script .= "$('#txtCurso').val(".json_encode($curso->getNombre()." ".$curso->getCiclo())."); 
                        $('#idCurso').html(".json_encode($curso->getId()).");";
        }
    }

    if (array_key_exists("idCuestionario", $_GET))
    {
        $cuestionario = ControladorCuestionario::getSingle(array('id' => $_GET["idCuestionario"]));

        if ($cuestionario !== NULL)
        {
            $script .= "$('#txtCuestionario').val(".json_encode($cuestionario->getNombre())."); 
                        $('#idCuestionario').html(".json_encode($cuestionario->getId()).");";
        }
    }

    $script .= "</script>";

    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    echo $pagina;
    echo $script;


 ?>