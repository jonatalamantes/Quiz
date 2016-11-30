<?php 
    
    require_once(__DIR__."/../Classes/NodoCuestionario.php");
    require_once("DatabaseManager.php");

    /**
    * Class for manipulate NodoCuestionario Objects
    * 
    * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
    */
    class ControladorNodoCuestionario
    {
        /**
         * Insert one respuestaOpcion in the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  NodoCuestionario $respuestaOpcion  The respuestaOpcion to insert
         * @return boolean           If was possible to insert
         */
        static function add($respuestaOpcion = null)
        {
            if ($respuestaOpcion === null)
            {
                return false;
            }

            $opciones = array('idPregunta'     => $respuestaOpcion->getIdPregunta(), 
                              'idOpcion'       => $respuestaOpcion->getIdOpcion(),
                              'idCuestionario' => $respuestaOpcion->getIdCuestionario());

            $singleNodoCuestionario = self::getSingle($opciones);

            if ($singleNodoCuestionario == null)
            {
                $idPregunta     = $respuestaOpcion->getIdPregunta();
                $idOpcion       = $respuestaOpcion->getIdOpcion();
                $idCuestionario = $respuestaOpcion->getIdCuestionario();

                $tableNodoCuestionario = DatabaseManager::getNameTable('TABLE_NODO_CUESTIONARIO');

                $query     = "INSERT INTO $tableNodoCuestionario 
                             (idPregunta, idOpcion, idCuestionario) 
                             VALUES 
                             ($idPregunta, $idOpcion, $idCuestionario)";

                if (DatabaseManager::singleAffectedRow($query) === true)
                {                    
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else //NodoCuestionario Exist
            {
                return false;
            }
        }

        /**
         * Delete one respuestaOpcion from the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  NodoCuestionario $respuestaOpcion  The respuestaOpcion to delete
         * @return boolean           if was possible to delete
         */
        static function remove($respuestaOpcion = null)
        {
            if ($respuestaOpcion === null)
            {
                return false;
            }
            else
            {
                $opciones = array('idPregunta'     => $respuestaOpcion->getIdPregunta(), 
                                  'idOpcion'       => $respuestaOpcion->getIdOpcion(),
                                  'idCuestionario' => $respuestaOpcion->getIdCuestionario());

                $singleNodoCuestionario = self::getSingle($opciones);

                if ($singleNodoCuestionario != null)
                {
                    $tableNodoCuestionario  = DatabaseManager::getNameTable('TABLE_NODO_CUESTIONARIO');
                    
                    $idPregunta = $respuestaOpcion->getIdPregunta();
                    $idOpcion   = $respuestaOpcion->getIdOpcion();
                    $idCuestionario = $respuestaOpcion->getIdCuestionario();

                    $query     = "DELETE FROM $tableNodoCuestionario
                                  WHERE idPregunta = $idPregunta 
                                  AND idOpcion = $idOpcion
                                  AND idCuestionario = $idCuestionario";
                                    
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
         * @return Curso  $curso_simple  Curso result or null
         */
        static function getSingle($keysValues = array())
        {
            if (!is_array($keysValues) || empty($keysValues))
            {
                return null;
            }

            $tableNodoCuestionario  = DatabaseManager::getNameTable('TABLE_NODO_CUESTIONARIO');

            $query     = "SELECT $tableNodoCuestionario.* 
                          FROM $tableNodoCuestionario
                          WHERE ";

            foreach ($keysValues as $key => $value) 
            {
                $query .= "$tableNodoCuestionario.$key = '$value' AND ";
            }

            $query = substr($query, 0, strlen($query)-4);

            $relacion = DatabaseManager::singleFetchAssoc($query);
            
            if ($relacion !== NULL)
            {
                $relacionObj = new NodoCuestionario();
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
        * @return Curso  $curso_simple  Curso result or null
        */
        static function filter($keysValues = array(), $begin = 0, $cantidad = 10)
        {
            if (!is_array($keysValues) || empty($keysValues))
            {
                return null;
            }

            $tableNodoCuestionario  = DatabaseManager::getNameTable('TABLE_NODO_CUESTIONARIO');
            $tableCuestionario      = DatabaseManager::getNameTable('TABLE_CUESTIONARIO');
            $tableOpcion            = DatabaseManager::getNameTable('TABLE_OPCION');
            $tablePregunta          = DatabaseManager::getNameTable('TABLE_PREGUNTA');

            $query     = "SELECT $tableNodoCuestionario.* 
                          FROM $tableNodoCuestionario
                          INNER JOIN $tableOpcion 
                          ON $tableOpcion.id = $tableNodoCuestionario.idOpcion
                          INNER JOIN $tableCuestionario 
                          ON $tableCuestionario.id = $tableNodoCuestionario.idCuestionario
                          INNER JOIN $tablePregunta
                          ON $tablePregunta.id = $tableNodoCuestionario.idPregunta
                          WHERE $tableCuestionario.activo = 'S' 
                          AND $tableOpcion.activo = 'S' 
                          AND $tablePregunta.activo = 'S' 
                          AND ";

            foreach ($keysValues as $key => $value) 
            {
                $query .= "$tableNodoCuestionario.$key LIKE '%$value%' AND ";
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

                    $relacionA = new NodoCuestionario();
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