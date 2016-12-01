<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorCuestionario.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorNodoCuestionario.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorOpcion.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorPregunta.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorRelacionCuestionarioCurso.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorCurso.php");

    SessionManager::validateUserInPage("menu_admin.php");

    $pagina = file_get_contents("Templates/InsertarCuestionario.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Insertar Cuestionario", $pagina);

    $id = 0;

    if (array_key_exists("id", $_GET))
    {
        $id = $_GET["id"];
    }
    else
    {
        echo "<script>window.location.href='cuestionario_menu.php'</script>"; die;
    }

    //Create the button
    $saveButton = '<button type="button" class="btn btn-warning" onclick=\'validateData("cuestionario_insertar.php", "cuestionario_menu.php")\'>
                      <img src="icons/saveLight.png" height="50px"><br>
                      <strong>Guardar</strong>
                   </button>';

    $cancelButton = '<button type="button" class="btn btn-warning" onclick=\'href("cuestionario_menu.php")\'>
                        <img src="icons/deleteLight.png" height="50px"><br>
                        <strong>Cancelar</strong>
                    </button>';

    $returnButton = '<button type="button" class="btn btn-warning" onclick=\'href("agregar_cuestionario_curso.php?idCuestionario='.$id.'")\'>
                        <img src="icons/cursoLight.png" height="50px"><br>
                        <strong>Agregar Curso</strong>
                    </button>';

    //Create a action for button cancel
    $pagina = str_replace("|SaveButton|"  , $saveButton  , $pagina);
    $pagina = str_replace("|CancelButton|", $cancelButton, $pagina);
    $pagina = str_replace("|ReturnButton|", $returnButton, $pagina);

    //Cargamos los datos del cuestionario
    $cuestionario = ControladorCuestionario::getSingle(array('id' => $id, 'activo' => "S"));

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
                $codigoScript = "";

                foreach ($estructura as $key => $nodoEstructura) 
                {
                    $idPregunta = $nodoEstructura["pregunta"]->getId();
                    $nombrePregunta = $nodoEstructura["pregunta"]->getDescripcion();

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
                        $codigoScript .= "<button class='btn btn-default' style='margin-top: 0px; margin-left: 3px' disabled>";

                        if ($opcionesEstructura->getCorrecta() == "S")
                        {
                            $codigoScript .= "<img src='icons/check.png' id='marca$idPregunta-$idOpcion' height='15px'>";
                        }
                        else
                        {
                            $codigoScript .= "<img src='icons/delete.png' id='marca$idPregunta-$idOpcion' height='15px'>";
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

                $pagina = str_replace('<td id="preguntas">' , '<td id="preguntas">'.$codigoScript , $pagina);
            }
        }

        $script = "<script> 

                $('#trNombrePregunta').css('display', 'none');
                $('#trTxtPregunta').css('display', 'none');

                $('#txtNombre').val('".$cuestionario->getNombre()."');
                $('#txtNombre').attr('disabled', 'true');

                </script>";

    }

    //Determinar si existen cursos que han tomado dicho cuestionario
    $cursosR = ControladorRelacionCuestionarioCurso::filter(array('idCuestionario' => $_GET["id"]), -1,-1);
    $cursos_string = "";

    if ($cursosR !== NULL)
    {
        $cursos_string .= "<table class='table table-condensed cf'>
                           <tbody style='margin-left: 20px; background-color: transparent; text-align: center;'>
                           <tr><td><label>CURSOS QUE PUEDEN CONTESTAR EL CUESTIONARIO</label></td></tr>";

        foreach ($cursosR as $key => $curso) 
        {
            $miCurso = ControladorCurso::getSingle(array('id' => $curso->getIdCurso()));

            $cursos_string .= "<tr><td>";
            $cursos_string .= "<div class='input-group'>";
            $cursos_string .= "    <div class='input-group-btn'>
                                        <button class='btn btn-default btn-info' style='margin-top: 0px;' 
                                        onclick='deleteRelacionCuestionarioCurso(\"".$curso->getIdCuestionario()."\", \"".$curso->getIdCurso()."\")'>
                                            <img src='icons/deleteLight.png' height='10px'>
                                        </button>
                                    </div>
                                    <input class='form-control agrupacion' type='text' value='". $miCurso->getNombre() ."' disabled>";
            $cursos_string .= "    <div class='input-group-btn'>
                                        <button class='btn btn-default btn-info' style='margin-top: 0px; margin-left: 3px' 
                                        onclick='href(\"alumno_curso_cuestionario.php?idCurso=".$miCurso->getId()."&idCuestionario=".$id."\")'>
                                            <img src='icons/searchLight.png' height='10px'>
                                        </button>
                                    </div>
                                </div></td></tr>";
        }

        $cursos_string .= "</tbody></table>";
    }

    $pagina = str_replace("|Cursos|", $cursos_string, $pagina);

    $pagina = str_replace("|Cuestionarios|", "", $pagina);
    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    echo $pagina;
    echo $script;

 ?>