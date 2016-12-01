<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorAlumno.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorRelacionAlumnoCurso.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorCurso.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorRespuestaAlumno.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorCuestionario.php");

    SessionManager::validateUserInPage("menu_admin.php");

    if (!array_key_exists("idCuestionario", $_GET) || !array_key_exists("idCurso", $_GET))
    {
        echo "<script>window.location.href='index.php'</script>"; die;
    }

    $pagina = file_get_contents("Templates/AlumnoCursoCuestionario.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Insertar Relacion Alumno Curso", $pagina);

    //Create the button
    $saveButton = '';

    $cancelButton = '<button type="button" class="btn btn-success" onclick=\'href("'.SessionManager::getLastPage().'")\'>
                      <img src="icons/returnLight.png" height="50px"><br>
                      <strong>Regresar</strong>
                   </button>';

    $returnButton = '';

    //Create a action for button cancel
    $pagina = str_replace("|SaveButton|"  , $saveButton  , $pagina);
    $pagina = str_replace("|CancelButton|", $cancelButton, $pagina);
    $pagina = str_replace("|ReturnButton|", $returnButton, $pagina);


    /* Creamos la tabla con el contenido de la informacion */

    //Buscamos el conjunto de estudiantes que estarán en la tabla
    $curso        = ControladorCurso::getSingle(array('id' => $_GET["idCurso"], 'activo' => 'S'));
    $cuestionario = ControladorCuestionario::getSingle(array('id' => $_GET["idCuestionario"], 'activo' => 'S'));
    $tablaContenido = "<table><tbody>";

    $relacionAlumnos = ControladorRelacionAlumnoCurso::filter(array('idCurso' => $curso->getId()), -1,-1);

    if ($relacionAlumnos !== NULL)
    {
        foreach ($relacionAlumnos as $key => $relacion)
        {
            $alumno = ControladorAlumno::getSingle(array('id' => $relacion->getIdAlumno(), "activo" => "S"));

            $tablaContenido .= "<tr><td>".$alumno->getPassword()."</td><td>".$alumno->getNombreCompleto()."</td>"; 

            //Revisamos si este usuarios ya ha contestado el cuestionario
            $respuestas = ControladorRespuestaAlumno::filter(array('idAlumno' => $alumno->getId(), 'idCuestionario' => $cuestionario->getId()));


            if ($respuestas == NULL)
            {
                $tablaContenido .= "<td> Sin Responder </td>";
            }
            else
            {
                $tablaContenido .= "<td> Con Respuesta </td>";
            }

            $tablaContenido .= "</tr>";
        }
    }

    $tablaContenido .= "</tbody></table>";

    $pagina = str_replace("|tableContest|", $tablaContenido, $pagina);
    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    echo $pagina;
    echo $script;


 ?>