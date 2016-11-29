<?php 

    require_once(__DIR__."/../../../Backend/Controlers/ControladorCurso.php");

    if (!array_key_exists("idCurso", $_POST))
    {
        echo "KO";
    }
    else
    {
        $status = $_POST["status"];

        $obj = new Curso( $_POST["idCurso"],
                          $_POST["txtNombre"],
                          $_POST["txtCiclo"]);

        if ($status == "insert")
        {
            if (ControladorCurso::add($obj))
            {
                echo "OK";
            }
            else
            {
                echo "KO";
            }
        }
        else if ($status == "update")
        {
            if (ControladorCurso::update($obj))
            {
                echo "OK";
            }
            else
            {
                echo "KO";
            }
        }
        else
        {
            echo "KO";
        }
    }

 ?>