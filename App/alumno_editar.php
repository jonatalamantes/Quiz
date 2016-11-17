<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorAlumno.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorRelacionAlumnoCurso.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorCurso.php");

    SessionManager::validateUserInPage("menu_admin.php");

    if (!array_key_exists("id", $_GET))
    {
        echo "<script>window.location.href='alumno_menu.php'</script>";
    }

    $pagina = file_get_contents("Templates/InsertarAlumno.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Editar Alumno", $pagina);

    //Create the button
    $saveButton = '<button type="button" class="btn btn-info" onclick=\'validateData("alumno_insertar.php", "update")\'>
                      <img src="icons/saveLight.png" height="50px"><br>
                      <strong>Guardar</strong>
                   </button>';

    $cancelButton = '<button type="button" class="btn btn-info" onclick=\'href("alumno_menu.php")\'>
                        <img src="icons/returnLight.png" height="50px"><br>
                        <strong>Cancelar</strong>
                    </button>';

    $returnButton = '<button type="button" class="btn btn-info" onclick=\'href("agregar_alumno_curso.php?idAlumno='.$_GET["id"].'")\'>
                        <img src="icons/cursoLight.png" height="50px"><br>
                        <strong>Agregar Curso</strong>
                    </button>';

    //Create a action for button cancel
    $pagina = str_replace("|SaveButton|"  , $saveButton  , $pagina);
    $pagina = str_replace("|CancelButton|", $cancelButton, $pagina);
    $pagina = str_replace("|ReturnButton|", $returnButton, $pagina);
    $pagina = str_replace("disabled", '', $pagina);

    //Obtenemos y ponemos los datos del registro
    $obj = ControladorAlumno::getSingle(array('id' => trim($_GET["id"])));

    $script .= "<script>
                    $('#idAlumno').html('".trim($_GET["id"])."');

                    $('#txtCodigo').val(".json_encode(trim($obj->getPassword())).");
                    $('#txtNombres').val(".json_encode(trim($obj->getNombres())).");
                    $('#txtApellidoPaterno').val(".json_encode(trim($obj->getApellidoPaterno())).");
                    $('#txtApellidoMaterno').val(".json_encode(trim($obj->getApellidoMaterno())).");
                    $('#selectTipo').val(".json_encode(trim($obj->getTipo())).");
                </script>";

    //Obtenemos los datos de la relacion
    $cursosR = ControladorRelacionAlumnoCurso::filter(array('idAlumno' => $_GET["id"]));
    $cursos_string = "";

    if ($cursosR !== NULL)
    {
        $cursos_string .= "<table class='table table-condensed cf'>
                           <tbody style='margin-left: 20px; background-color: transparent; text-align: center;'>
                           <tr><td><label>Cursos en los que esta Inscritos</label></td></tr>";

        foreach ($cursosR as $key => $curso) 
        {
            $miCurso = ControladorCurso::getSingle(array('id' => $curso->getIdCurso()));

            $cursos_string .= "<tr><td>";
            $cursos_string .= "<div class='input-group'>";
            $cursos_string .= "    <div class='input-group-btn'>
                                        <button class='btn btn-default btn-info' style='margin-top: 0px;' 
                                        onclick='deleteRelacionAlumnoCurso(\"".$curso->getIdAlumno()."\", \"".$curso->getIdCurso()."\")'>
                                            <img src='icons/deleteLight.png' height='10px'>
                                        </button>
                                    </div>
                                    <input class='form-control agrupacion' type='text' value='". $miCurso->getNombre() ."' disabled>";
            $cursos_string .= "    <div class='input-group-btn'>
                                        <button class='btn btn-default btn-info' style='margin-top: 0px; margin-left: 3px' 
                                        onclick='href(\"curso_ver.php?id=".$miCurso->getId()."\")'>
                                            <img src='icons/searchLight.png' height='10px'>
                                        </button>
                                    </div>
                                </div></td></tr>";

        }

        $cursos_string .= "</tbody></table>";
    }

    $pagina = str_replace("|Cursos|", $cursos_string, $pagina);

    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    echo $pagina;
    echo $script;


 ?>