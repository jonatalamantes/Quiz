<?php 

    require_once(__DIR__."/../../../Backend/Controlers/SessionManager.php");
    require_once(__DIR__."/../../../Backend/Controlers/ControladorRelacionCuestionarioCurso.php");

    if (!array_key_exists("idCuestionario", $_POST) || $_POST["idCuestionario"] === NULL || 
        !array_key_exists("idCurso", $_POST)  || $_POST["idCurso"]  === NULL)
    {
        echo "KO";
    }
    else
    {
        $obj = ControladorRelacionCuestionarioCurso::getSingle(array("idCuestionario" => $_POST["idCuestionario"], 
                                                               "idCurso"  => $_POST["idCurso"]));
            
        if ($obj !== NULL)
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
                $obj = new RelacionCuestionarioCurso();
                $obj->setIdCuestionario($_POST["idCuestionario"]);
                $obj->setIdCurso($_POST["idCurso"]);

                //Check for permision
                if (ControladorRelacionCuestionarioCurso::add($obj))
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