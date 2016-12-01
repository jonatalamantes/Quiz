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

            $opciones = array('idAlumno'   => $respuestaAlumno->getIdAlumno(), 
                              'idNodoCuestionario' => $respuestaAlumno->getIdNodoCuestionario());

            $singleRespuestaAlumno = self::getSingle($opciones);

            if ($singleRespuestaAlumno == null)
            {
                $idAlumno   = $respuestaAlumno->getIdAlumno();
                $idNodoCuestionario = $respuestaAlumno->getIdNodoCuestionario();

                $tableRespuestaAlumno = DatabaseManager::getNameTable('TABLE_RESPUESTA_ALUMNO');

                $query     = "INSERT INTO $tableRespuestaAlumno 
                             (idAlumno, idNodoCuestionario) 
                             VALUES 
                             ($idAlumno, $idNodoCuestionario)";

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
                $opciones = array('idAlumno'   => $respuestaAlumno->getIdAlumno(), 
                                  'idNodoCuestionario' => $respuestaAlumno->getIdNodoCuestionario());

                $singleRespuestaAlumno = self::getSingle($opciones);

                if ($singleRespuestaAlumno != null)
                {
                    $tableRespuestaAlumno  = DatabaseManager::getNameTable('TABLE_RESPUESTA_ALUMNO');
                    $idAlumno   = $respuestaAlumno->getIdAlumno();
                    $idNodoCuestionario = $respuestaAlumno->getIdNodoCuestionario();

                    $query     = "DELETE FROM $tableRespuestaAlumno
                                  WHERE idAlumno = $idAlumno AND idNodoCuestionario = $idNodoCuestionario";
                                    
                    return DatabaseManager::singleAffectedRow($query);
                }
            }
        }

        /**
         * Recover from database one Relacion object
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  string   $key          Key to search
         * @param  string   $value        Value of the key
         * @return NodoCuestionario  $curso_simple  NodoCuestionario result or null
         */
        static function getSingle($keysValues = array())
        {
            if (!is_array($keysValues) || empty($keysValues))
            {
                return null;
            }

            $tableRespuestaAlumno  = DatabaseManager::getNameTable('TABLE_RESPUESTA_ALUMNO');

            $query     = "SELECT $tableRespuestaAlumno.* 
                          FROM $tableRespuestaAlumno
                          WHERE ";

            foreach ($keysValues as $key => $value) 
            {
                $query .= "$tableRespuestaAlumno.$key = '$value' AND ";
            }

            $query = substr($query, 0, strlen($query)-4);

            $relacion = DatabaseManager::singleFetchAssoc($query);
            
            if ($relacion !== NULL)
            {
                $relacionObj = new RespuestaAlumno();
                $relacionObj->fromArray($relacion);
            }

            return $relacionObj;
        }


        /**
        * Recover from database one Relacion objects
        * 
        * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
        * @param  string   $key          Key to search
        * @param  string   $value        Value of the key
        * @return NodoCuestionario  $curso_simple  NodoCuestionario result or null
        */
        static function filter($keysValues = array(), $begin = 0, $cantidad = 10)
        {
            if (!is_array($keysValues) || empty($keysValues))
            {
                return null;
            }

            $tableRespuestaAlumno  = DatabaseManager::getNameTable('TABLE_RESPUESTA_ALUMNO');
            $tableNodoCuestionario = DatabaseManager::getNameTable('TABLE_NODO_CUESTIONARIO');
            $tableAlumno           = DatabaseManager::getNameTable('TABLE_ALUMNO');

            $query     = "SELECT $tableRespuestaAlumno.* 
                          FROM $tableRespuestaAlumno
                          INNER JOIN $tableAlumno 
                          ON $tableAlumno.id = $tableRespuestaAlumno.idAlumno
                          INNER JOIN $tableNodoCuestionario
                          ON $tableNodoCuestionario.id = $tableRespuestaAlumno.idNodoCuestionario
                          WHERE $tableAlumno.activo = 'S' 
                          AND ";

            foreach ($keysValues as $key => $value) 
            {
                $query .= "$key LIKE '%$value%' AND ";
            }

            $query = substr($query, 0, strlen($query)-4);

            if ($begin >= 0)
            {
                $query = $query. " LIMIT " . strval($begin * $cantidad) . ", " . strval($cantidad+1);    
            }

            $arrayRelaciones    = DatabaseManager::multiFetchAssoc($query);
            $relaciones_simples = array();

            if ($arrayRelaciones !== NULL)
            {
                $i = 0;
                foreach ($arrayRelaciones as $relacion_simple) 
                {
                    if ($i == $cantidad && $begin >= 0)
                    {
                      continue;
                    }

                    $relacionA = new RespuestaAlumno();
                    $relacionA->fromArray($relacion_simple);
                    $relaciones_simple[] = $relacionA;
                    $i++;
                }

                return $relaciones_simple;
            }
            else
            {
                return null;
            }
        }
    }

 ?>