<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorAlumno.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorRelacionAlumnoCurso.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorCurso.php");

    SessionManager::validateUserInPage("menu_admin.php");

    if (!array_key_exists("idAlumno", $_GET) && !array_key_exists("idCurso", $_GET))
    {
        echo "<script>window.location.href='menu_admin.php'</script>";
    }

    $pagina = file_get_contents("Templates/InsertarRelacionBinaria.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Insertar Relacion Alumno Curso", $pagina);

    $pagina = str_replace("|Obj1|", "Alumno", $pagina);
    $pagina = str_replace("|Obj2|", "Curso", $pagina);

    //Create the button
    $saveButton = '<button type="button" class="btn btn-info" onclick=\'validateData("agregar_alumno_curso.php", "'.SessionManager::getLastPage().'")\'>
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

    if (array_key_exists("idAlumno", $_GET))
    {
        $alumno = ControladorAlumno::getSingle(array('id' => $_GET["idAlumno"]));

        if ($alumno !== NULL)
        {
            $script .= "$('#txtAlumno').val(".json_encode($alumno->getNombreCompleto())."); 
                        $('#idAlumno').html(".json_encode($alumno->getId()).");";
        }
    }

    $script .= "</script>";

    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    echo $pagina;
    echo $script;


 ?>