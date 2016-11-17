<?php 
    
    require_once(__DIR__."/../Classes/RelacionAlumnoCurso.php");
    require_once("DatabaseManager.php");

    /**
    * Class for manipulate RelacionAlumnoCurso Objects
    * 
    * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
    */
    class ControladorRelacionAlumnoCurso
    {
        /**
         * Insert one respuestaAlumno in the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  RelacionAlumnoCurso $respuestaAlumno  The respuestaAlumno to insert
         * @return boolean           If was possible to insert
         */
        static function add($respuestaAlumno = NULL)
        {
            if ($respuestaAlumno === NULL)
            {
                return false;
            }

            var_dump($respuestaAlumno);

            $opciones = array('idCurso'  => $respuestaAlumno->getIdCurso(), 
                              'idAlumno' => $respuestaAlumno->getIdAlumno());

            $singleRelacionAlumnoCurso = self::getSingle($opciones);

            if ($singleRelacionAlumnoCurso == NULL)
            {
                $idCurso  = $respuestaAlumno->getIdCurso();
                $idAlumno = $respuestaAlumno->getIdAlumno();

                $tableRelacionAlumnoCurso = DatabaseManager::getNameTable('TABLE_REL_ALUMNO_CURSO');

                $query     = "INSERT INTO $tableRelacionAlumnoCurso 
                             (idCurso, idAlumno) 
                             VALUES 
                             ($idCurso, $idAlumno)";

                if (DatabaseManager::singleAffectedRow($query) === true)
                {                    
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else //RelacionAlumnoCurso Exist
            {
                return false;
            }
        }

        /**
         * Delete one respuestaAlumno from the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  RelacionAlumnoCurso $respuestaAlumno  The respuestaAlumno to delete
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
                $opciones = array('idCurso'   => $respuestaAlumno->getIdCurso(), 
                                  'idAlumno' => $respuestaAlumno->getIdAlumno());

                $singleRelacionAlumnoCurso = self::getSingle($opciones);

                if ($singleRelacionAlumnoCurso != null)
                {
                    $tableRelacionAlumnoCurso  = DatabaseManager::getNameTable('TABLE_REL_ALUMNO_CURSO');
                    $idCurso   = $respuestaAlumno->getIdCurso();
                    $idAlumno = $respuestaAlumno->getIdAlumno();

                    $query     = "DELETE FROM $tableRelacionAlumnoCurso
                                  WHERE idCurso = $idCurso AND idAlumno = $idAlumno";
                                    
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

            $tableRelacionAlumnoCurso  = DatabaseManager::getNameTable('TABLE_REL_ALUMNO_CURSO');

            $query     = "SELECT $tableRelacionAlumnoCurso.* 
                          FROM $tableRelacionAlumnoCurso
                          WHERE ";

            foreach ($keysValues as $key => $value) 
            {
                $query .= "$tableRelacionAlumnoCurso.$key = '$value' AND ";
            }

            $query = substr($query, 0, strlen($query)-4);

            $relacion = DatabaseManager::singleFetchAssoc($query);
            
            if ($relacion !== NULL)
            {
                $relacionObj = new RelacionAlumnoCurso();
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
        static function filter($keysValues = array(), $order = 'id', $begin = 0, $cantidad = 10)
        {
            if (!is_array($keysValues) || empty($keysValues))
            {
                return null;
            }

            $tableRelacionAlumnoCurso  = DatabaseManager::getNameTable('TABLE_REL_ALUMNO_CURSO');
            $tableCurso                = DatabaseManager::getNameTable('TABLE_CURSO');
            $tableAlumno               = DatabaseManager::getNameTable('TABLE_ALUMNO');

            $query     = "SELECT $tableRelacionAlumnoCurso.* 
                          FROM $tableRelacionAlumnoCurso
                          INNER JOIN $tableAlumno 
                          ON $tableAlumno.id = $tableRelacionAlumnoCurso.idAlumno
                          INNER JOIN $tableCurso
                          ON $tableCurso.id = $tableRelacionAlumnoCurso.idCurso
                          WHERE $tableCurso.activo = 'S' 
                          AND $tableAlumno.activo = 'S' 
                          AND ";

            foreach ($keysValues as $key => $value) 
            {
                $query .= "$tableRelacionAlumnoCurso.$key LIKE '%$value%' AND ";
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

                    $relacionA = new RelacionAlumnoCurso();
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