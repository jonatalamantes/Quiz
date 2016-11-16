<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorAlumno.php");

    SessionManager::validateUserInPage("menu_admin.php");

    $pagina = file_get_contents("Templates/MenuAlumno.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Menú de Alumnos", $pagina);

    //Validate the URL

    if (array_key_exists("page", $_GET))
    {
        $numberPage = intval($_GET["page"]);
    }
    else
    {
        $numberPage = 0;
    }

    if (array_key_exists("sort", $_GET))
    {
        $sortType = $_GET["sort"];    
    }

    if (array_key_exists("keyword", $_GET))
    {
        $simpleKeyword = $_GET["keyword"];    
    }

    if (array_key_exists("kid", $_GET))
    {
        $kid = $_GET["kid"];
    }
    
    $desplegar = 10;

    if ($sortType == NULL || $sortType == '')
    {
        $sortType = 'id';
    }

    if ($numberPage === NULL || $numberPage < 0) //Invalid Page
    {
        echo "<script src='../JS/functions.js'></script><script>nextPage('set', '0')</script>";
    }

    //Getting all registries
    if ($simpleKeyword !== NULL)
    {
        $AlumnoRegistries = ControladorAlumno::simpleSearch($simpleKeyword, $sortType, $numberPage);
    }
    else if ($kid !== NULL)
    {
        $opciones = array();

        $opciones["tipo"]            = $_GET["ktipo"];
        $opciones["nombres"]         = $_GET["kinputNames"];
        $opciones["apellidoPaterno"] = $_GET["kinputLastname1"];
        $opciones["apellidoMaterno"] = $_GET["kinputLastname2"];
        $opciones["password"]        = $_GET["kinputCodigo"];

        if (array_key_exists('klimite', $_GET))
        {
            $klimite = -1;
            $AlumnoRegistries = ControladorAlumno::filter($opciones, $sortType, -1, -1);
        }
        else
        {
            $AlumnoRegistries = ControladorAlumno::filter($opciones, $sortType, $numberPage);
        }
    }
    else
    {
        $AlumnoRegistries = ControladorAlumno::getAll($sortType, $numberPage);
    }

    //Get the total of registries
    $totalRegistries    = DatabaseManager::getAffectedRows();
    $affectedRegistries = DatabaseManager::registriesAffectedLastQuery();

    if ($klimite == -1)
    {
        $desplegar = $affectedRegistries;
    }

    $lastPage = floor($affectedRegistries/$desplegar);

    if ($affectedRegistries%$desplegar === 0)
    {
        $lastPage = floor($affectedRegistries/$desplegar)-1;
    }

    if ($totalRegistries === 0 && $numberPage !== 0)
    {
        echo "<script src='../JS/functions.js'></script><script>nextPage('set', '0')</script>";
    }

    //Create contest for button next and prev
    $nextButtonString = '<button type="button" 
                                 class="btn btn-info"
                                 onclick="nextPage(\'true\')">
                        Siguiente</button>';

    $prevButtonString = '<button type="button" 
                                 class="btn btn-info"
                                 onclick="nextPage(\'false\')">
                        Anterior</button>';

    $beggButtonString = '<button type="button" 
                                 class="btn btn-info"
                                 onclick="nextPage(\'set\', \'0\')">
                        Primera</button>';

    $lastButtonString = '<button type="button" 
                                 class="btn btn-info"
                                 onclick="nextPage(\'set\', \''. $lastPage .'\')">
                        Última</button>';

    //Create a table of registries
    $table = "<h4 style='text-align:center'>No se encontró contenido</h4>";

    if ($AlumnoRegistries !== NULL && $totalRegistries != 0)
    {
        $table = '<table class="col-md-12 table-condensed table-bordered cf" id="table1">';

        $table = $table . '<tbody>';

        $header = '<tr>
                        <th data-title="" colspan="4" class="center"><strong>Alumnos ['.$affectedRegistries.']</strong></th>
                        <th data-title="Sort" style="text-align: center" class="center">
                            ^Sort By^ 
                            <select class="form-control" id="sortType" onchange="loadSort(\'alumno_menu.php\')">
                                <option ' . ($sortType=='id' ?     'selected' : '') . '>Reciente</option>
                                <option ' . ($sortType=='nombres' ?   'selected' : '') . '>Nombres</option>
                                <option ' . ($sortType=='apellidoPaterno' ?   'selected' : '') . '>Apellidos</option>
                            </select>
                        </th>
                    </tr>
                    <tr style="text-align: center;">
                        <th style="text-align: center;" class="hideOnMinus">Código</th>
                        <th style="text-align: center;" class="hideOnMinus">Nombre Completo</th>
                        <th style="text-align: center;" class="hideOnMinus">Tipo Alumnos</th>
                        <th style="text-align: center;" class="hideOnMinus">Fecha Registro</th>
                        <th style="text-align: center;" class="hideOnMinus">Opciones</th>
                    </tr>';

        $table = $table . $header;

        $i = 0;
        foreach ($AlumnoRegistries as $alumno) 
        {
            $options = '<td data-title="Opciones" class="center-btn" style="text-align: center">
                <button type="button" class="btn btn-info" onclick="href(\'alumno_ver.php?id=' . $alumno->getID() . '\')">
                    <img src="icons/ojo.png" class="img-inside" height="30px">
                </button>
                <button type="button" class="btn btn-info" onclick="href(\'alumno_editar.php?id=' . $alumno->getID() . '\')">
                    <img src="icons/updateLight.png" class="img-inside" height="30px">
                </button>
                <button type="button" class="btn btn-info" onclick="deleteObject(\'alumno\', \'' . $alumno->getID() . '\')">
                    <img src="icons/deleteLight.png" class="img-inside" height="30px">
                </button>
            </td>';

            $table = $table . '<tr style="text-align:center">';
            $table = $table . '<td data-title="Código">' . $alumno->getPassword()       . '</td>' . "\n\t\t\t\t\t";
            $table = $table . '<td data-title="Nombre">' . $alumno->getNombreCompleto() . '</td>' . "\n\t\t\t\t\t";
            $table = $table . '<td data-title="Tipo">'   . $alumno->getTipo()           . '</td>' . "\n\t\t\t\t\t";
            $table = $table . '<td data-title="Fecha">'  . $alumno->getFechaRegistro()  . '</td>' . "\n\t\t\t\t\t";
            $table = $table . $options;
            $table = $table . '</tr>';
        }

        $table = $table . '</tbody></table>';
    }

    //Display the table
    $pagina = str_replace("|tableContest|", $table, $pagina);

    if ($totalRegistries === $desplegar+1)
    {
        //put the next button
        $pagina = str_replace("|buttonNext|", $nextButtonString, $pagina);
    }
    else
    {
        //delete the next button
        $pagina = str_replace("|buttonNext|", "\n", $pagina);
    }

    if ($numberPage === 0)
    {
        //delete previus button
        $pagina = str_replace("|buttonPrev|", "\n", $pagina);

        //delete first button
        $pagina = str_replace("|buttonFirst|", "\n", $pagina);
    }
    else
    {
        //put the previus button
        $pagina = str_replace("|buttonPrev|", $prevButtonString, $pagina);

        //put the first button
        $pagina = str_replace("|buttonFirst|", $beggButtonString, $pagina);
    }

    if ($numberPage < $lastPage)
    {
        //put the next button
        $pagina = str_replace("|buttonLast|", $lastButtonString, $pagina);
    }
    else
    {
        $pagina = str_replace("|buttonLast|", "\n", $pagina);
    }

    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    echo $pagina;


 ?>