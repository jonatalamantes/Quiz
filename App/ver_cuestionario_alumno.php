<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorCuestionario.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorNodoCuestionario.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorOpcion.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorPregunta.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorRelacionCuestionarioCurso.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorCurso.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorAlumno.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorRespuestaAlumno.php");

    SessionManager::validateUserInPage("menu_normal.php");

    $pagina = file_get_contents("Templates/InsertarCuestionario.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Insertar Cuestionario", $pagina);

    $idAlumno = 0;
    $idCuestionario = 0;

    if (array_key_exists("idAlumno", $_GET) && array_key_exists("idCuestionario", $_GET))
    {
        $idAlumno= $_GET["idAlumno"];
        $idCuestionario= $_GET["idCuestionario"];
    }
    else
    {
        echo "<script>window.location.href='cuestionario_menu.php'</script>"; die;
    }

    //Create the button
    $saveButton = '';

    $cancelButton = '<button type="button" class="btn btn-warning" onclick=\'href("'.SessionManager::getLastPage().'")\'>
                        <img src="icons/returnLight.png" height="50px"><br>
                        <strong>Regresar</strong>
                    </button>';

    $returnButton = '';

    //Create a action for button cancel
    $pagina = str_replace("|SaveButton|"  , $saveButton  , $pagina);
    $pagina = str_replace("|CancelButton|", $cancelButton, $pagina);
    $pagina = str_replace("|ReturnButton|", $returnButton, $pagina);

    //Cargamos los datos del cuestionario
    $cuestionario = ControladorCuestionario::getSingle(array('id' => $idCuestionario, 'activo' => "S"));
    $alumno       = ControladorAlumno::getSingle(array('id' => $idAlumno, 'activo' => "S"));

    //var_dump($cuestionario);

    if ($cuestionario !== NULL)
    {
        $nodos = ControladorNodoCuestionario::filter(array('idCuestionario' => $cuestionario->getId()));

        if ($nodos !== NULL)
        {
            //Generamos una estructura temporal
            $ultimaPregunta = array('pregunta' => new Pregunta());
            $estructura = array();
            $contador = -1;

            foreach ($nodos as $key => $nodo) 
            {
                if ($ultimaPregunta["pregunta"]->getId() !== $nodo->getIdPregunta())
                {
                    $ptemp = ControladorPregunta::getSingle(array('id' => $nodo->getIdPregunta(), 'activo' => 'S'));
                    $pregunta = array('pregunta' => $ptemp, 'opciones' => $opciones);

                    $ultimaPregunta = $pregunta;
                    $estructura[] = $ultimaPregunta;
                    $contador++;
                }

                $opcion = ControladorOpcion::getSingle(array('id' => $nodo->getIdOpcion(), 'activo' => 'S'));
                $estructura[$contador]["opciones"][] = $opcion;
            }

            //Iteramos en relacion de la nueva estructura generando el código de Javascript

            if (!empty($pregunta))
            {
                $cantidadCorrectas = 0;
                $cantidadPreguntas = 0;
                $codigoScript = "";

                foreach ($estructura as $key => $nodoEstructura) 
                {
                    $idPregunta = $nodoEstructura["pregunta"]->getId();
                    $nombrePregunta = $nodoEstructura["pregunta"]->getDescripcion();
                    $cantidadPreguntas++;

                    $codigoScript .= "<div id='pregunta$idPregunta'>";
                    $codigoScript .= "<div class='wellEspecial well'>";
                    $codigoScript .= "<label>$nombrePregunta</label>";

                    $codigoScript .= "<table id='tablaOpcionesPregunta$nombrePregunta' class='table table-condensed cf' style='background-color: transparent'><tbody>";

                    foreach ($nodoEstructura["opciones"] as $key => $opcionesEstructura) 
                    {
                        $idOpcion = $opcionesEstructura->getId();
                        $valorOpcion = $opcionesEstructura->getDescripcion();

                        $codigoScript .= "<tr id='filaOpcion$idPregunta-$idOpcion'><td>";
                        $codigoScript .= "<div class='input-group'>";
                        $codigoScript .= "<div class='input-group-btn'>";

                        $nodoCuestionario = ControladorNodoCuestionario::getSingle(array('idPregunta' => $idPregunta, 
                                                                                         'idOpcion' => $idOpcion,
                                                                                         'idCuestionario' => $idCuestionario));

                        $opciones = array('idNodoCuestionario' => $nodoCuestionario->getId(), 'idAlumno' => $idAlumno);
                        $respuestaAlumno = ControladorRespuestaAlumno::getSingle($opciones);

                        if ($respuestaAlumno !== NULL)
                        {
                            $codigoScript .= "<button class='btn btn-info' style='margin-top: 0px; margin-left: 3px' disabled>";
                        }
                        else
                        {
                            $codigoScript .= "<button class='btn btn-default' style='margin-top: 0px; margin-left: 3px' disabled>";

                        }

                        if ($opcionesEstructura->getCorrecta() == "S")
                        {
                            $codigoScript .= "<img src='icons/check.png' id='marca$idPregunta-$idOpcion' height='15px'>";
                        }
                        else
                        {
                            $codigoScript .= "<img src='icons/delete.png' id='marca$idPregunta-$idOpcion' height='15px'>";
                        }

                        if ($opcionesEstructura->getCorrecta() == "S" && $respuestaAlumno !== NULL)
                        {
                            $cantidadCorrectas++;
                        }

                        $codigoScript .= "</button>";   
                        $codigoScript .= "</div>";
                        $codigoScript .= "<input type='text' id='opcion$idPregunta-$idOpcion' class='form-control' value='$valorOpcion' disabled>";
                        $codigoScript .= "</div>";
                        $codigoScript .= "</td></tr>";
                    }

                    $codigoScript .= "</tbody></table>";
                    $codigoScript .= "</div>";
                }

                $codigoScript .= "<h4>NOTA: Las opciones que aparecen en Azul son las respuestas del alumno</h4>";
                $codigoScript .= "<h4>NOTA: Las opciones que aparecen con la palomita son las respuestas correctas</h4>";
                $codigoScript .= "<h4>Ha contestado $cantidadCorrectas Correctas de $cantidadPreguntas Posibles</h4>";
                $codigoScript .= "<h4>Calificación: <strong>".(($cantidadCorrectas/$cantidadPreguntas)*100)."</strong></h4>";

                $pagina = str_replace('<td id="preguntas">' , '<td id="preguntas">'.$codigoScript , $pagina);
            }
        }

        $script = "<script> 

                $('#trNombrePregunta').css('display', 'none');
                $('#trTxtPregunta').css('display', 'none');

                $('#txtNombre').val('[".$cuestionario->getNombre()."] RESPONDIDO POR [".$alumno->getNombreCompleto()."]');
                $('#txtNombre').attr('disabled', 'true');

                </script>";

    }

    $pagina = str_replace("|Cursos|", $cursos_string, $pagina);

    $pagina = str_replace("|Cuestionarios|", "", $pagina);
    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    echo $pagina;
    echo $script;

 ?>