<?php 

    require_once(__DIR__."/../../../Backend/Controlers/SessionManager.php");
    require_once(__DIR__."/../../../Backend/Controlers/ControladorRelacionAlumnoCurso.php");

    if (!array_key_exists("idAlumno", $_POST) || $_POST["idAlumno"] === NULL || 
        !array_key_exists("idCurso", $_POST)  || $_POST["idCurso"]  === NULL)
    {
        echo "KO";
    }
    else
    {
        $obj = ControladorRelacionAlumnoCurso::getSingle(array("idAlumno" => $_POST["idAlumno"], 
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
                $obj = new RelacionAlumnoCurso();
                $obj->setIdAlumno($_POST["idAlumno"]);
                $obj->setIdCurso($_POST["idCurso"]);

                //Check for permision
                if (ControladorRelacionAlumnoCurso::add($obj))
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