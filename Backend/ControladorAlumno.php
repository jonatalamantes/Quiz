<?php 
    
    require_once("Alumno.php");
    require_once("DatabaseManager.php");

    /**
    * Class for manipulate Alumno Objects
    * 
    * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
    */
    class ControladorAlumno
    {
        /**
         * Recover from database one Alumno object by id
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  string   $key          Key to search
         * @param  string   $value        Value of the key
         * @return Alumno  $alumno_simple  Alumno result or null
         */
        static function getSingle($key  = 'id', $value = '',
                                  $key2 = 'id', $value2 = '',
                                  $key3 = 'id', $value3 = '',
                                  $key4 = 'id', $value4 = '')
        {
            if ($value === '')
            {
                return null;
            }

            $tableAlumno  = DatabaseManager::getNameTable('TABLE_ALUMNO');

            $query     = "SELECT $tableAlumno.* 
                          FROM $tableAlumno
                          WHERE $tableAlumno.$key = '$value'";

            if ($value2 !== "")
            {
                $query = $query . " AND $tableAlumno.$key2 = '$value2'";
            }

            if ($value3 !== "")
            {
                $query = $query . " AND $tableAlumno.$key3 = '$value3'";
            }

            if ($value4 !== "")
            {
                $query = $query . " AND $tableAlumno.$key4 = '$value4'";
            }

            $alumno_simple      = DatabaseManager::singleFetchAssoc($query);
            $alumno_simple      = self::ArrayToAlumno($alumno_simple);

            return $alumno_simple;
        }

        /**
         * Recover all Alumno from the database begin in one part of the alumno_simple table
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  string            $order       The type of sort of the Alumno
         * @param  integer           $begin       The number of page to display the registry
         * @return Array[Alumno]    $alumno_simples    Array of Alumno Object
         */
        static function getAll($order = 'id', $begin = 0, $cantidad = 10)
        {
            $tableAlumno  = DatabaseManager::getNameTable('TABLE_ALUMNO');

            $query     = "SELECT $tableAlumno.*
                          FROM $tableAlumno
                          ORDER BY ";

            if ($order == 'nombres')
            {
                $query = $query . " $tableAlumno.nombres";
            }
            else if ($order == 'apellidoPaterno')
            {
                $query = $query . " $tableAlumno.apellidoPaterno";
            }
            else
            {
                $query = $query . " $tableAlumno.id DESC";
            }

            if ($begin >= 0)
            {
                $query = $query. " LIMIT " . strval($begin * $cantidad) . ", " . strval($cantidad+1);    
            }

            $arrayAlumnos   = DatabaseManager::multiFetchAssoc($query);
            $alumno_simples = array();

            if ($arrayAlumnos !== NULL)
            {
                $i = 0;
                foreach ($arrayAlumnos as $alumno_simple) 
                {
                    if ($i == $cantidad && $begin >= 0)
                    {
                        continue;
                    }

                    $alumnoA = new Alumno();
                    $alumnoA->fromArray($alumno_simple);
                    $alumno_simples[] = $alumnoA;
                    $i++;
                }

                return $alumno_simples;
            }
            else
            {
                return null;
            }
        }

        /**
         * Insert one alumno in the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  Alumno $alumno  The alumno to insert
         * @return boolean           If was possible to insert
         */
        static function add($alumno = null)
        {
            if ($alumno === null)
            {
                return false;
            }

            $singleAlumno = self::getSingle('nombres',         $alumno->getNombres(),
                                            'apellidoPaterno', $alumno->getApellidoPaterno(),
                                            'apellidoMaterno', $alumno->getApellidoMaterno());

            if ($singleAlumno->disimilitud($alumno) == 1)
            {
                $nombres         = $alumno->getNombres();
                $apellidoPaterno = $alumno->getApellidoPaterno();
                $apellidoMaterno = $alumno->getApellidoPaterno();

                $tableAlumno = DatabaseManager::getNameTable('TABLE_ALUMNO');

                $query     = "INSERT INTO $tableAlumno 
                             (nombres, apellidoPaterno, apellidoMaterno) 
                             VALUES 
                             ('$nombres', '$apellidoPaterno', '$apellidoMaterno')";

                if (DatabaseManager::singleAffectedRow($query) === true)
                {                    
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else //Alumno Exist
            {
                return false;
            }
        }

        /**
         * Insert one alumno in the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  Alumno $alumno  The alumno to insert
         * @return boolean           If was possible to insert
         */
        static function update($alumno = NULL)
        {
            if ($alumno === null)
            {
                return false;
            }

            $singleAlumno = self::getSingle('nombres',         $alumno->getNombres(),
                                            'apellidoPaterno', $alumno->getApellidoPaterno(),
                                            'apellidoMaterno', $alumno->getApellidoMaterno());

            if ($singleAlumno->disimilitud($alumno) > 0)
            {
                $id              = $singleAlumno->getId();
                $nombres         = $alumno->getNombres();
                $apellidoPaterno = $alumno->getApellidoPaterno();
                $apellidoMaterno = $alumno->getApellidoPaterno();

                $tableAlumno = DatabaseManager::getNameTable('TABLE_ALUMNO');

                $query     = "UPDATE $tableAlumno 
                              SET nombres         = '$nombres', 
                                  apellidoPaterno = '$apellidoPaterno', 
                                  apellidoMaterno = '$apellidoMaterno', 
                             WHERE $tableAlumno.id = '$id'";

                if (DatabaseManager::singleAffectedRow($query) === true)
                {                    
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else //Alumno Exist
            {
                return false;
            }
        }

        /**
         * Delete one alumno from the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  Alumno $alumno  The alumno to delete
         * @return boolean           if was possible to delete
         */
        static function remove($alumno = null)
        {
            if ($alumno === null)
            {
                return false;
            }
            else
            {
                $tableAlumno  = DatabaseManager::getNameTable('TABLE_ALUMNO');
                $id           = $alumno->getId();

                $query     = "UPDATE $tableAlumno
                              SET activo = 'N' WHERE id = $id";
                                
                return DatabaseManager::singleAffectedRow($query);
            }
        }
    }
    
 ?>