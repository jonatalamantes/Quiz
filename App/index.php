<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorAlumno.php");

    ControladorAlumno::terminarSesion();

    $pagina = file_get_contents("Templates/login.html");
    echo $pagina;

 ?>