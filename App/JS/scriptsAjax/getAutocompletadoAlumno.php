<?php 

    require_once(__DIR__."/../../../Backend/Controlers/ControladorAlumno.php");

    if (!array_key_exists("term", $_GET) || $_GET["term"] === NULL)
    {
        echo "";
        die;
    }
    
    $json = ControladorAlumno::getAutocompletado($_GET["term"]);
    echo $json;
    
 ?>