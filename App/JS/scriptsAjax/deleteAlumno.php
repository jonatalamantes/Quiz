<?php 

    require_once(__DIR__."/../../../Backend/Controlers/SessionManager.php");
    require_once(__DIR__."/../../../Backend/Controlers/ControladorAlumno.php");


    if (!isset($_GET) || $_GET["id"] === NULL)
    {
        echo "KO";
    }
    else
    {
        $obj = ControladorAlumno::getSingle(array("id" => $_GET["id"]));
            
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
                if (ControladorAlumno::remove($obj))
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