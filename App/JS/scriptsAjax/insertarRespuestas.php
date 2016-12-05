<?php 

    require_once(__DIR__."/../../../Backend/Controlers/SessionManager.php");
    require_once(__DIR__."/../../../Backend/Controlers/ControladorCuestionario.php");
    require_once(__DIR__."/../../../Backend/Controlers/ControladorPregunta.php");
    require_once(__DIR__."/../../../Backend/Controlers/ControladorOpcion.php");
    require_once(__DIR__."/../../../Backend/Controlers/ControladorNodoCuestionario.php");
    require_once(__DIR__."/../../../Backend/Controlers/ControladorRespuestaAlumno.php");

    if (!array_key_exists("data", $_POST) || !array_key_exists("nombreCuestionario", $_POST))
    {
        echo "KO";
    }
    else
    {
        $cuestionario = ControladorCuestionario::getSingle(array('nombre' => $_POST["nombreCuestionario"]));

        if ($cuestionario !== NULL)
        {
            $correctaUna = false;

            //Obtenemos el nodo por cada respuesta
            foreach ($_POST["data"] as $key => $dato) 
            {
                $pregunta = ControladorPregunta::getSingle(array('id' => $dato["numeroPregunta"]));
                $opcion   = ControladorOpcion::getSingle(array('id' => $dato["numeroOpcion"]));

                //Obtenemos el nodo
                $nodo = ControladorNodoCuestionario::getSingle(array('idPregunta' => $pregunta->getId(),
                                                             'idOpcion' => $opcion->getId(),
                                                             'idCuestionario' => $cuestionario->getId()));

                $idAlumno = SessionManager::getIdAlumno();

                if ($nodo !== NULL && $idAlumno !== NULL)
                {
                    $respuesta = new RespuestaAlumno();
                    $respuesta->setIdAlumno($idAlumno);
                    $respuesta->setIdNodoCuestionario($nodo->getId());

                    if (ControladorRespuestaAlumno::add($respuesta))
                    {
                        $correctaUna = true;
                    }
                }
            }

            if ($correctaUna)
            {
                echo "OK"; die;
            }
            else
            {
                echo "KO2"; die;
            }
        }
        else
        {
            echo "KO1"; die;
        }
    }


 ?>