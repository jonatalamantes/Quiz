<?php 

    require_once(__DIR__."/../../../Backend/Controlers/ControladorAlumno.php");


    if (!array_key_exists("idAlumno", $_POST))
    {
        echo "KO";
    }
    else
    {
        $status = $_POST["status"];

        $obj = new Alumno( $_POST["idAlumno"],
                           $_POST["txtNombres"],
                           $_POST["txtApellidoPaterno"],
                           $_POST["txtApellidoMaterno"],
                           $_POST["txtCodigo"],
                           $_POST["selectTipo"]);

        if ($status == "insert")
        {
            if (ControladorAlumno::add($obj))
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
            if (ControladorAlumno::update($obj))
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