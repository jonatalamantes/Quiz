<?php 

    require_once(__DIR__."/../../../Backend/Controlers/ControladorCuestionario.php");

    if (!array_key_exists("term", $_GET) || $_GET["term"] === NULL)
    {
        echo "";
        die;
    }
    
    $json = ControladorCuestionario::getAutocompletado($_GET["term"]);
    echo $json;
    
 ?>