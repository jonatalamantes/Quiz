<?php 
    
    require_once(__DIR__."/../Classes/RespuestaAlumno.php");
    require_once("DatabaseManager.php");

    /**
    * Class for manipulate RespuestaAlumno Objects
    * 
    * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
    */
    class ControladorRespuestaAlumno
    {
        /**
         * Insert one respuestaAlumno in the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  RespuestaAlumno $respuestaAlumno  The respuestaAlumno to insert
         * @return boolean           If was possible to insert
         */
        static function add($respuestaAlumno = null)
        {
            if ($respuestaAlumno === null)
            {
                return false;
            }

            $opciones = array('idOpcion'   => $respuestaAlumno->getIdOpcion(), 
                              'idPregunta' => $respuestaAlumno->getIdPregunta());

            $singleRespuestaAlumno = self::getSingle($opciones);

            if ($singleRespuestaAlumno == null)
            {
                $idOpcion   = $respuestaAlumno->getIdOpcion();
                $idPregunta = $respuestaAlumno->getIdPregunta();

                $tableRespuestaAlumno = DatabaseManager::getNameTable('TABLE_RESPUESTA_ALUMNO');

                $query     = "INSERT INTO $tableRespuestaAlumno 
                             (idOpcion, idPregunta) 
                             VALUES 
                             ($idOpcion, $idPregunta)";

                if (DatabaseManager::singleAffectedRow($query) === true)
                {                    
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else //RespuestaAlumno Exist
            {
                return false;
            }
        }

        /**
         * Delete one respuestaAlumno from the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  RespuestaAlumno $respuestaAlumno  The respuestaAlumno to delete
         * @return boolean           if was possible to delete
         */
        static function remove($respuestaAlumno = null)
        {
            if ($respuestaAlumno === null)
            {
                return false;
            }
            else
            {
                $opciones = array('idOpcion'   => $respuestaAlumno->getIdOpcion(), 
                                  'idPregunta' => $respuestaAlumno->getIdPregunta());

                $singleRespuestaAlumno = self::getSingle($opciones);

                if ($singleRespuestaAlumno != null)
                {
                    $tableRespuestaAlumno  = DatabaseManager::getNameTable('TABLE_RESPUESTA_ALUMNO');
                    $idOpcion   = $respuestaAlumno->getIdOpcion();
                    $idPregunta = $respuestaAlumno->getIdPregunta();

                    $query     = "DELETE FROM $tableRespuestaAlumno
                                  WHERE idOpcion = $idOpcion AND idPregunta = $idPregunta";
                                    
                    return DatabaseManager::singleAffectedRow($query);
                }
            }
        }
    }

 ?>