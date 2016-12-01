<?php 
    
    require_once(__DIR__."/../Classes/RelacionCuestionarioCurso.php");
    require_once("DatabaseManager.php");

    /**
    * Class for manipulate RelacionCuestionarioCurso Objects
    * 
    * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
    */
    class ControladorRelacionCuestionarioCurso
    {
        /**
         * Insert one respuestaCuestionario in the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  RelacionCuestionarioCurso $respuestaCuestionario  The respuestaCuestionario to insert
         * @return boolean           If was possible to insert
         */
        static function add($respuestaCuestionario = null)
        {
            if ($respuestaCuestionario === null)
            {
                return false;
            }

            $opciones = array('idCurso'        => $respuestaCuestionario->getIdCurso(), 
                              'idCuestionario' => $respuestaCuestionario->getIdCuestionario());

            $singleRelacionCuestionarioCurso = self::getSingle($opciones);

            if ($singleRelacionCuestionarioCurso == null)
            {
                $idCurso        = $respuestaCuestionario->getIdCurso();
                $idCuestionario = $respuestaCuestionario->getIdCuestionario();

                $tableRelacionCuestionarioCurso = DatabaseManager::getNameTable('TABLE_REL_CUESTIONARIO_CURSO');

                $query     = "INSERT INTO $tableRelacionCuestionarioCurso 
                             (idCurso, idCuestionario) 
                             VALUES 
                             ($idCurso, $idCuestionario)";

                if (DatabaseManager::singleAffectedRow($query) === true)
                {                    
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else //RelacionCuestionarioCurso Exist
            {
                return false;
            }
        }

        /**
         * Delete one respuestaCuestionario from the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  RelacionCuestionarioCurso $respuestaCuestionario  The respuestaCuestionario to delete
         * @return boolean           if was possible to delete
         */
        static function remove($respuestaCuestionario = null)
        {
            if ($respuestaCuestionario === null)
            {
                return false;
            }
            else
            {
                $opciones = array('idCurso'        => $respuestaCuestionario->getIdCurso(), 
                                  'idCuestionario' => $respuestaCuestionario->getIdCuestionario());

                $singleRelacionCuestionarioCurso = self::getSingle($opciones);

                if ($singleRelacionCuestionarioCurso != null)
                {
                    $tableRelacionCuestionarioCurso  = DatabaseManager::getNameTable('TABLE_REL_CUESTIONARIO_CURSO');
                    
                    $idCurso        = $respuestaCuestionario->getIdCurso();
                    $idCuestionario = $respuestaCuestionario->getIdCuestionario();

                    $query     = "DELETE FROM $tableRelacionCuestionarioCurso
                                  WHERE idCurso = $idCurso AND idCuestionario = $idCuestionario";
                                    
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

            $tableRelacionCuestionarioCurso  = DatabaseManager::getNameTable('TABLE_REL_CUESTIONARIO_CURSO');

            $query     = "SELECT $tableRelacionCuestionarioCurso.* 
                          FROM $tableRelacionCuestionarioCurso
                          WHERE ";

            foreach ($keysValues as $key => $value) 
            {
                $query .= "$tableRelacionCuestionarioCurso.$key = '$value' AND ";
            }

            $query = substr($query, 0, strlen($query)-4);

            $relacion = DatabaseManager::singleFetchAssoc($query);
            
            if ($relacion !== NULL)
            {
                $relacionObj = new RelacionCuestionarioCurso();
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

            $tableRelacionCuestionarioCurso  = DatabaseManager::getNameTable('TABLE_REL_CUESTIONARIO_CURSO');
            $tableCurso                      = DatabaseManager::getNameTable('TABLE_CURSO');
            $tableCuestionario               = DatabaseManager::getNameTable('TABLE_CUESTIONARIO');

            $query     = "SELECT $tableRelacionCuestionarioCurso.* 
                          FROM $tableRelacionCuestionarioCurso
                          INNER JOIN $tableCuestionario 
                          ON $tableCuestionario.id = $tableRelacionCuestionarioCurso.idCuestionario
                          INNER JOIN $tableCurso
                          ON $tableCurso.id = $tableRelacionCuestionarioCurso.idCurso
                          WHERE $tableCurso.activo = 'S' 
                          AND $tableCuestionario.activo = 'S' 
                          AND ";

            foreach ($keysValues as $key => $value) 
            {
                $query .= "$tableRelacionCuestionarioCurso.$key LIKE '%$value%' AND ";
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

                    $relacionA = new RelacionCuestionarioCurso();
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