<?php 

    require_once(__DIR__."/../../../Backend/Controlers/SessionManager.php");
    require_once(__DIR__."/../../../Backend/Controlers/ControladorCurso.php");


    if (!isset($_GET) || $_GET["id"] === NULL)
    {
        echo "KO";
    }
    else
    {
        $obj = ControladorCurso::getSingle(array("id" => $_GET["id"]));
            
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
                if (ControladorCurso::remove($obj))
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