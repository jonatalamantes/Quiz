<?php 

    require_once(__DIR__."/../../../Backend/Controlers/SessionManager.php");
    require_once(__DIR__."/../../../Backend/Controlers/ControladorRelacionAlumnoCurso.php");


    if (!array_key_exists("idAlumno", $_GET) || $_GET["idAlumno"] === NULL || 
        !array_key_exists("idCurso", $_GET)  || $_GET["idCurso"]  === NULL)
    {
        echo "KO";
    }
    else
    {
        $obj = ControladorRelacionAlumnoCurso::getSingle(array("idAlumno" => $_GET["idAlumno"], 
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
                if (ControladorRelacionAlumnoCurso::remove($obj))
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