<?php 

    require_once(__DIR__."/../Backend/Controlers/ControladorAlumno.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorRespuestaAlumno.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorRelacionAlumnoCurso.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorRelacionCuestionarioCurso.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorCurso.php");
    require_once(__DIR__."/../Backend/Controlers/ControladorCuestionario.php");

    SessionManager::validateUserInPage("menu_normal.php");

    $alumno = SessionManager::getIdAlumno();
    $alumno = ControladorAlumno::getSingle(array('id' => $alumno));

    $pagina = file_get_contents("Templates/MenuNormal.html");
    $pagina = str_replace("|NavBar|", SessionManager::getNavBar(), $pagina);
    $pagina = str_replace("|title|", "Menú Principal", $pagina);
    $pagina = str_replace("|Username|", $alumno->getNombreCompleto(), $pagina);

    //Conseguimos la lista de cuestionarios que hacen falta por contestar
    $idAlumno = SessionManager::getIdAlumno();
    $relacionCursos = ControladorRelacionAlumnoCurso::filter(array('idAlumno' => $idAlumno), -1,-1);

    $arrayCuestionarios = array();

    if ($relacionCursos !== NULL)
    {
        foreach ($relacionCursos as $key => $relacion)
        {
            $curso = ControladorCurso::getSingle(array('id' => $relacion->getIdCurso(), "activo" => "S"));

            if ($curso !== NULL)
            {
            	$cuestionarios = ControladorRelacionCuestionarioCurso::filter(array('idCurso' => $curso->getId()));

            	if ($cuestionarios !== NULL)
            	{
            		foreach ($cuestionarios as $key => $cuestionarioS) 
            		{
            			$encontrado = false;
            			foreach ($arrayCuestionarios as $key => $value) 
            			{
            				if ($value->getId() == $cuestionarioS->getIdCuestionario())
            				{
            					$encontrado = true;
            					break;
            				}
            			}

            			if (!$encontrado)
            			{
            				$cuestionarioPush = ControladorCuestionario::getSingle(array('id' => $cuestionarioS->getIdCuestionario()));

            				if ($cuestionarioPush->getActivo() == "S")
            				{
            					$arrayCuestionarios[] = $cuestionarioPush;
            				}
            			}
            		}
            	}
            }
        }
    }

    //Creamos la tabla de los cuestionarios
    $tablaContenido = ' <div class="container">
                        <div id="no-more-tables">
						<table class="col-md-12 table-condensed table-bordered cf" id="table1">';
    $tablaContenido .= '<tbody style="text-align:center">';

    $header = '<tr>
                    <th data-title="" colspan="2" class="center"><strong>Cuestionarios Pendientes</strong></th>
                </tr>
                <tr style="text-align: center;">
                    <th style="text-align: center;" class="hideOnMinus">Nombre Del Cuestionario</th>
                    <th style="text-align: center;" class="hideOnMinus">Opciones</th>
                </tr>
                ';

     $tablaContenido .= $header;

     $minimoUno = false;
    if (!empty($arrayCuestionarios))
    {
    	foreach ($arrayCuestionarios as $key => $cuestionario) 
    	{
		    //Revisamos si este usuarios ya ha contestado el cuestionario
		    $respuestas = ControladorRespuestaAlumno::filter(array('idAlumno' => $idAlumno, 'idCuestionario' => $cuestionario->getId()));

		    if ($respuestas == NULL)
		    {
		    	$minimoUno = true;
		    	$tablaContenido .= "<tr>";
		        $tablaContenido .= "<td td data-title='Cuestionario'>".$cuestionario->getNombre()."</td>";
		        $tablaContenido .= "<td td data-title='Opciones'> 
		        						<button class='btn btn-success'> Contestar </button> 
		        					</td>";
		       	$tablaContenido .= "</tr>";
		    }
    	}
    }

    $tablaContenido .= "</tbody></table></div></div>";

    if ($minimoUno)
    {
    	$pagina = str_replace("|Cuestionarios|", $tablaContenido, $pagina);
    }
    else
    {
    	$contenido = "<p class='lead'>
    						<label>Sin Cuestionarios Pendientes</label> <br> 
    						<button class='btn btn-success' onclick='href(\"alumno_ver.php?id=".$idAlumno."\")'> Ver Perfil </button>
    				  </p>";
    	$pagina = str_replace("|Cuestionarios|", $contenido, $pagina);
    }

    $pagina = LanguageSupport::HTMLEvalLanguage($pagina);

    echo $pagina;

 ?>