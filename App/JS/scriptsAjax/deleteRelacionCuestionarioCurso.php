<?php 

    require_once(__DIR__."/../../../Backend/Controlers/SessionManager.php");
    require_once(__DIR__."/../../../Backend/Controlers/ControladorRelacionCuestionarioCurso.php");


    if (!array_key_exists("idCuestionario", $_GET) || $_GET["idCuestionario"] === NULL || 
        !array_key_exists("idCurso", $_GET)  || $_GET["idCurso"]  === NULL)
    {
        echo "KO";
    }
    else
    {
        $obj = ControladorRelacionCuestionarioCurso::getSingle(array("idCuestionario" => $_GET["idCuestionario"], 
                                                               "idCurso"  => $_GET["idCurso"]));
            
        var_dump($obj);

        if ($obj === NULL)
        {
            echo "KO";
        }
        else
        {
            if (!isset($_SESSION))
            {
                echo "KO";
            }
            else
            {
                //Check for permision
                if (ControladorRelacionCuestionarioCurso::remove($obj))
                {
                    echo "OK";
                }
                else
                {
                    echo "KO";
                }
            }
        }
    }

 ?>