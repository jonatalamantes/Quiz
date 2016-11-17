<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorAlumno.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorRelacionAlumnoCurso.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorCurso.php");

    SessionManager::validateUserInPage("menu_admin.php");

    if (!array_key_exists("id", $_GET))
    {
        echo "<script>window.location.href='curso_menu.php'</script>";
    }

    $pagina = file_get_contents("Templates/InsertarCurso.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Ver Curso", $pagina);

    //Create the button
    $saveButton = '';

    $cancelButton = '<button type="button" class="btn btn-success" onclick=\'href("curso_menu.php")\'>
                        <img src="icons/returnLight.png" height="50px"><br>
                        <strong>Regresar</strong>
                    </button>';

    $returnButton = '';

    //Create a action for button cancel
    $pagina = str_replace("|SaveButton|"  , $saveButton  , $pagina);
    $pagina = str_replace("|CancelButton|", $cancelButton, $pagina);
    $pagina = str_replace("|ReturnButton|", $returnButton, $pagina);

    //Obtenemos y ponemos los datos del registro
    $obj = ControladorCurso::getSingle(array('id' => trim($_GET["id"])));

    $script .= "<script>
                    $('#idCurso').html('".trim($_GET["id"])."');

                    $('#txtCiclo').val(".json_encode(trim($obj->getCiclo())).");
                    $('#txtNombre').val(".json_encode(trim($obj->getNombre())).");
                </script>";

    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    //Obtenemos los datos de la relacion
    $alumnoR = ControladorRelacionAlumnoCurso::filter(array('idCurso' => $_GET["id"]),-1,-1);
    $alumnos_string = "";

    if ($alumnoR !== NULL)
    {
        $alumnos_string .= "<table class='table table-condensed cf'>
                           <tbody style='margin-left: 20px; background-color: transparent; text-align: center;'>
                           <tr><td><label>Alumnos que estan inscritos</label></td></tr>";

        foreach ($alumnoR as $key => $alumno) 
        {
            $miAlumno = ControladorAlumno::getSingle(array('id' => $alumno->getIdAlumno()));
            $alumnos_string .= "<tr><td>";
            $alumnos_string .= "<div class='input-group'>
                                    <input class='form-control agrupacion' type='text' value='". $miAlumno->getNombreCompleto() ."' disabled>";
            $alumnos_string .= "    <div class='input-group-btn'>
                                        <button class='btn btn-default btn-success' style='margin-top: 0px; margin-left: 3px' 
                                        onclick='href(\"alumno_ver.php?id=".$miAlumno->getId()."\")'>
                                            <img src='icons/searchLight.png' height='10px'>
                                        </button>
                                    </div>
                                </div></td></tr>";
        }

        $alumnos_string .= "</tbody></table>";
    }

    $pagina = str_replace("|Alumnos|", $alumnos_string, $pagina);

    echo $pagina;
    echo $script;


 ?>