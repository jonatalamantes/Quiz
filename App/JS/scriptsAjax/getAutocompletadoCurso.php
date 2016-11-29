<?php 

    require_once(__DIR__."/../../../Backend/Controlers/ControladorCurso.php");

    if (!array_key_exists("term", $_GET) || $_GET["term"] === NULL)
    {
        echo "";
        die;
    }
    
    $json = ControladorCurso::getAutocompletado($_GET["term"]);
    echo $json;
    
 ?>