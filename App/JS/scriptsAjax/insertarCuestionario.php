<?php 

    require_once(__DIR__."/../../../Backend/Controlers/SessionManager.php");
    require_once(__DIR__."/../../../Backend/Controlers/ControladorCuestionario.php");
    require_once(__DIR__."/../../../Backend/Controlers/ControladorPregunta.php");
    require_once(__DIR__."/../../../Backend/Controlers/ControladorOpcion.php");
    require_once(__DIR__."/../../../Backend/Controlers/ControladorNodoCuestionario.php");

    die;

    if (!array_key_exists("data", $_POST))
    {
        echo "KO";
    }
    else
    {
        $cuestionario = new Cuestionario(0, $_POST["nombreCuestionario"]);

        if (ControladorCuestionario::add($cuestionario))
        {
            $cuestionario = ControladorCuestionario::getLast();

            foreach ($_POST["data"] as $key => $pregunta) 
            {
                $preguntaN = new Pregunta(0, $pregunta["nombrePregunta"]);

                if (ControladorPregunta::add($preguntaN))
                {
                    $preguntaN = ControladorPregunta::getLast();

                    foreach ($pregunta["opciones"] as $key => $opcion) 
                    {
                        if ($opcion["respuesta"] == true)
                        {
                            $opcionN = new Opcion(0, $opcion["descripcion"], 'S');
                        }
                        else
                        {
                            $opcionN = new Opcion(0, $opcion["descripcion"], 'N');
                        }

                        if (ControladorOpcion::add($opcionN))
                        {
                            $opcionN = ControladorOpcion::getLast();

                            $nodo = new NodoCuestionario(0, $opcionN->getId(), $preguntaN->getId(), $cuestionario->getId());
                            ControladorNodoCuestionario::add($nodo);
                        }
                        else
                        {
                            echo "KO3"; die;
                        }
                    }
                }
                else
                {
                    echo "KO2"; die;
                }
            }
        }
        else
        {
            echo "KO1"; die;
        }

        echo "OK";
    }


 ?>