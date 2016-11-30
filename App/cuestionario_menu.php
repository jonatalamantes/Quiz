<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorCuestionario.php");

    SessionManager::validateUserInPage("menu_admin.php");

    $pagina = file_get_contents("Templates/MenuCuestionario.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Menú de Cuestionarios", $pagina);

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
        $CuestionarioRegistries = ControladorCuestionario::simpleSearch($simpleKeyword, $sortType, $numberPage);
    }
    else if ($kid !== NULL)
    {
        $opciones = array();

        $opciones["nombre"] = $_GET["knombre"];

        if (array_key_exists('klimite', $_GET))
        {
            $klimite = -1;
            $CuestionarioRegistries = ControladorCuestionario::filter($opciones, $sortType, -1, -1);
        }
        else
        {
            $CuestionarioRegistries = ControladorCuestionario::filter($opciones, $sortType, $numberPage);
        }
    }
    else
    {
        $CuestionarioRegistries = ControladorCuestionario::getAll($sortType, $numberPage);
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
                                 class="btn btn-warning"
                                 onclick="nextPage(\'true\')">
                        Siguiente</button>';

    $prevButtonString = '<button type="button" 
                                 class="btn btn-warning"
                                 onclick="nextPage(\'false\')">
                        Anterior</button>';

    $beggButtonString = '<button type="button" 
                                 class="btn btn-warning"
                                 onclick="nextPage(\'set\', \'0\')">
                        Primera</button>';

    $lastButtonString = '<button type="button" 
                                 class="btn btn-warning"
                                 onclick="nextPage(\'set\', \''. $lastPage .'\')">
                        Última</button>';

    //Create a table of registries
    $table = "<h4 style='text-align:center'>No se encontró contenido</h4>";

    if ($CuestionarioRegistries !== NULL && $totalRegistries != 0)
    {
        $table = '<table class="col-md-12 table-condensed table-bordered cf" id="table1">';

        $table = $table . '<tbody>';

        $header = '<tr>
                        <th data-title="" colspan="3" class="center"><strong>Cuestionarios ['.$affectedRegistries.']</strong></th>
                        <th data-title="Sort" style="text-align: center" class="center">
                            ^Sort By^ 
                            <select class="form-control" id="sortType" onchange="loadSort(\'cuestionario_menu.php\')">
                                <option ' . ($sortType=='id' ?      'selected' : '') . '>Reciente</option>
                                <option ' . ($sortType=='nombre' ?  'selected' : '') . '>Nombre</option>
                            </select>
                        </th>
                    </tr>
                    <tr style="text-align: center;">
                        <th style="text-align: center;" class="hideOnMinus">ID</th>
                        <th style="text-align: center;" class="hideOnMinus">Nombre</th>
                        <th style="text-align: center;" class="hideOnMinus">Fecha Registro</th>
                        <th style="text-align: center;" class="hideOnMinus">Opciones</th>
                    </tr>';

        $table = $table . $header;

        $i = 0;
        foreach ($CuestionarioRegistries as $cuestionario) 
        {
            $options = '<td data-title="Opciones" class="center-btn" style="text-align: center">
                <button type="button" class="btn btn-warning" onclick="href(\'cuestionario_ver.php?id=' . $cuestionario->getID() . '\')">
                    <img src="icons/ojo.png" class="img-inside" height="30px">
                </button>
                <button type="button" class="btn btn-warning" onclick="deleteObject(\'cuestionario\', \'' . $cuestionario->getID() . '\')">
                    <img src="icons/deleteLight.png" class="img-inside" height="30px">
                </button>
            </td>';

            $table = $table . '<tr style="text-align:center">';
            $table = $table . '<td data-title="ID">'     . $cuestionario->getID()       . '</td>' . "\n\t\t\t\t\t";
            $table = $table . '<td data-title="Nombre">' . $cuestionario->getNombre() . '</td>' . "\n\t\t\t\t\t";
            $table = $table . '<td data-title="Fecha">'  . $cuestionario->getFechaRegistro()  . '</td>' . "\n\t\t\t\t\t";
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