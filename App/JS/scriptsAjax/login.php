<?php 

    require_once("../../../Backend/Controlers/ControladorAlumno.php");

    $llaves = array('password' => $_POST["codigo"]);
    $alumno = ControladorAlumno::getSingle($llaves);

    if ($alumno == NULL)
    {
        echo "KO";
    }
    else
    {
        echo "OK";
    }

 ?>