<?php 
    
    require_once(__DIR__."/../Classes/Cuestionario.php");
    require_once("DatabaseManager.php");

    /**
    * Class for manipulate Cuestionario Objects
    * 
    * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
    */
    class ControladorCuestionario
    {
        /**
         * Recover from database one Cuestionario object by id
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  string   $key          Key to search
         * @param  string   $value        Value of the key
         * @return Cuestionario  $cuestionario_simple  Cuestionario result or null
         */
        static function getSingle($keysValues = array())
        {
            if (!is_array($keysValues) || empty($keysValues))
            {
                return null;
            }

            $tableCuestionario  = DatabaseManager::getNameTable('TABLE_CUESTIONARIO');

            $query     = "SELECT $tableCuestionario.* 
                          FROM $tableCuestionario
                          WHERE ";

            foreach ($keysValues as $key => $value) 
            {
                $query .= "$tableCuestionario.$key = '$value' AND ";
            }

            $query = substr($query, 0, strlen($query)-4);

            $cuestionario_s = DatabaseManager::singleFetchAssoc($query);

            if ($cuestionario_s !== null)
            {
                $cuestionarioA = new Cuestionario();
                $cuestionarioA->fromArray($cuestionario_s);
            }

            return $cuestionarioA;
        }

        /**
         * Recover all Cuestionario from the database begin in one part of the cuestionario_simple table
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  string            $order       The type of sort of the Cuestionario
         * @param  integer           $begin       The number of page to display the registry
         * @return Array[Cuestionario]    $cuestionario_simples    Array of Cuestionario Object
         */
        static function getLast()
        {
            $tableCuestionario  = DatabaseManager::getNameTable('TABLE_CUESTIONARIO');

            $query     = "SELECT $tableCuestionario.* 
                          FROM $tableCuestionario
                          ORDER BY id DESC";

            $cuestionario_simple = DatabaseManager::singleFetchAssoc($query);

            $cuestionarioA = new Cuestionario();
            $cuestionarioA->fromArray($cuestionario_simple);

            return $cuestionarioA;
        }

        /**
         * Recover all Cuestionario from the database begin in one part of the cuestionario_simple table
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  string            $order       The type of sort of the Cuestionario
         * @param  integer           $begin       The number of page to display the registry
         * @return Array[Cuestionario]    $cuestionario_simples    Array of Cuestionario Object
         */
        static function getAll($order = 'id', $begin = 0, $cantidad = 10)
        {
            $tableCuestionario  = DatabaseManager::getNameTable('TABLE_CUESTIONARIO');

            $query     = "SELECT $tableCuestionario.*
                          FROM $tableCuestionario
                          WHERE $tableCuestionario.activo = 'S'
                          ORDER BY ";

            if ($order == 'nombre')
            {
                $query = $query . " $tableCuestionario.nombre";
            }
            else
            {
                $query = $query . " $tableCuestionario.id DESC";
            }

            if ($begin >= 0)
            {
                $query = $query. " LIMIT " . strval($begin * $cantidad) . ", " . strval($cantidad+1);    
            }

            $arrayCuestionarios   = DatabaseManager::multiFetchAssoc($query);
            $cuestionario_simples = array();

            if ($arrayCuestionarios !== NULL)
            {
                $i = 0;
                foreach ($arrayCuestionarios as $cuestionario_simple) 
                {
                    if ($i == $cantidad && $begin >= 0)
                    {
                        continue;
                    }

                    $cuestionarioA = new Cuestionario();
                    $cuestionarioA->fromArray($cuestionario_simple);
                    $cuestionario_simples[] = $cuestionarioA;
                    $i++;
                }

                return $cuestionario_simples;
            }
            else
            {
                return null;
            }
        }

        /**
         * Insert one cuestionario in the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  Cuestionario $cuestionario  The cuestionario to insert
         * @return boolean           If was possible to insert
         */
        static function add($cuestionario = null)
        {
            if ($cuestionario === null)
            {
                return false;
            }

            $opciones = array('nombre' => $cuestionario->getNombre());

            $singleCuestionario = self::getSingle($opciones);

            if ($singleCuestionario === null || $singleCuestionario->disimilitud($cuestionario) == 1)
            {
                $nombre = $cuestionario->getNombre();

                $tableCuestionario = DatabaseManager::getNameTable('TABLE_CUESTIONARIO');

                $query     = "INSERT INTO $tableCuestionario 
                             (nombre) 
                             VALUES 
                             ('$nombre')";

                if (DatabaseManager::singleAffectedRow($query) === true)
                {                    
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else //Cuestionario Exist
            {
                return false;
            }
        }

        /**
         * Insert one cuestionario in the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  Cuestionario $cuestionario  The cuestionario to insert
         * @return boolean           If was possible to insert
         */
        static function update($cuestionario = NULL)
        {
            if ($cuestionario === null)
            {
                return false;
            }

            $opciones = array('id' => $cuestionario->getId());

            $singleCuestionario = self::getSingle($opciones);

            if ($singleCuestionario->disimilitud($cuestionario) > 0)
            {
                $opciones = array('nombre' => $cuestionario->getNombre());

                $singleCuestionario = self::getSingle($opciones);

                if ($singleCuestionario->disimilitud($cuestionario) == 1)
                {
                    $id                        = $singleCuestionario->getId();
                    $nombre                    = $cuestionario->getNombre();

                    $tableCuestionario = DatabaseManager::getNameTable('TABLE_CUESTIONARIO');

                    $query     = "UPDATE $tableCuestionario 
                                  SET nombre                 = '$nombre'
                                  WHERE $tableCuestionario.id = '$id'";

                    if (DatabaseManager::singleAffectedRow($query) === true)
                    {                    
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return false;
                }
            }
            else //Cuestionario Exist
            {
                return false;
            }
        }

        /**
         * Delete one cuestionario from the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  Cuestionario $cuestionario  The cuestionario to delete
         * @return boolean           if was possible to delete
         */
        static function remove($cuestionario = null)
        {
            if ($cuestionario === null)
            {
                return false;
            }
            else
            {
                $tableCuestionario  = DatabaseManager::getNameTable('TABLE_CUESTIONARIO');
                $id           = $cuestionario->getId();

                $query     = "UPDATE $tableCuestionario
                              SET activo = 'N' WHERE id = $id";
                                
                return DatabaseManager::singleAffectedRow($query);
            }
        }

        /**
         * Search one bitacoraSI by one similar name
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  string         $string       Necesary string to search
         * @param  string         $order        The type of sort of the BitacoraSI
         * @param  integer        $begin        The number of page to display the registry
         * @return Array[BitacoraSI] $bitacoraSIs     BitacoraSI objects with the similar name or null
         */
        static function getAutocompletado($string = '')
        {
            $tableCuestionario  = DatabaseManager::getNameTable('TABLE_CUESTIONARIO');

            $query     = "SELECT $tableCuestionario.*
                          FROM $tableCuestionario
                          WHERE ($tableCuestionario.nombre LIKE '%$string%') AND
                                 $tableCuestionario.activo = 'S'";

            $arrayCuestionarios   = DatabaseManager::multiFetchAssoc($query);
            $cuestionario_simples = array();
            $return               = array();

            if ($arrayCuestionarios !== NULL)
            {
                foreach ($arrayCuestionarios as $cuestionario_simple) 
                {
                    $cuestionarioA = new Cuestionario();
                    $cuestionarioA->fromArray($cuestionario_simple);

                    array_push($return, array('label' => $cuestionarioA->getNombre(),
                          'id' => $cuestionarioA->getId())
                         );
                }

                return json_encode($return);
            }
            else
            {
                return null;
            }
        }

        /**
         * Search one bitacoraSI by one similar name
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  string         $string       Necesary string to search
         * @param  string         $order        The type of sort of the BitacoraSI
         * @param  integer        $begin        The number of page to display the registry
         * @return Array[BitacoraSI] $bitacoraSIs     BitacoraSI objects with the similar name or null
         */
        static function simpleSearch($string = '', $order = "id", $begin = 0, $cantidad = 10)
        {
            $tableCuestionario  = DatabaseManager::getNameTable('TABLE_CUESTIONARIO');

            $query     = "SELECT $tableCuestionario.*
                          FROM $tableCuestionario
                          WHERE ($tableCuestionario.nombre LIKE '%$string%') AND
                                 $tableCuestionario.activo = 'S'
                          ORDER BY ";

            if ($order == 'nombre')
            {
                $query = $query . " $tableCuestionario.nombre";
            }
            else
            {
                $query = $query . " $tableCuestionario.id DESC";
            }

            if ($begin >= 0)
            {
                $query = $query. " LIMIT " . strval($begin * $cantidad) . ", " . strval($cantidad+1);    
            }

            $arrayCuestionarios   = DatabaseManager::multiFetchAssoc($query);
            $cuestionario_simples = array();

            if ($arrayCuestionarios !== NULL)
            {
                $i = 0;
                foreach ($arrayCuestionarios as $cuestionario_simple) 
                {
                    if ($i == $cantidad && $begin >= 0)
                    {
                        continue;
                    }

                    $cuestionarioA = new Cuestionario();
                    $cuestionarioA->fromArray($cuestionario_simple);
                    $cuestionario_simples[] = $cuestionarioA;
                    $i++;
                }

                return $cuestionario_simples;
            }
            else
            {
                return null;
            }
        }

      /**
       * Recover from database one Cuestionario object by id
       * 
       * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
       * @param  string   $key          Key to search
       * @param  string   $value        Value of the key
       * @return Cuestionario  $cuestionario_simple  Cuestionario result or null
       */
      static function filter($keysValues = array(), $order = 'id', $begin = 0, $cantidad = 10)
      {
          if (!is_array($keysValues) || empty($keysValues))
          {
              return null;
          }

          $tableCuestionario  = DatabaseManager::getNameTable('TABLE_CUESTIONARIO');

          $query     = "SELECT $tableCuestionario.* 
                        FROM $tableCuestionario
                        WHERE $tableCuestionario.activo = 'S' AND ";

          foreach ($keysValues as $key => $value) 
          {
              $query .= "$tableCuestionario.$key LIKE '%$value%' AND ";
          }

          $query = substr($query, 0, strlen($query)-4);
          $query .= " ORDER BY ";

          if ($order == 'nombre')
          {
              $query = $query . " $tableCuestionario.nombre";
          }
          else
          {
              $query = $query . " $tableCuestionario.id DESC";
          }

          if ($begin >= 0)
          {
              $query = $query. " LIMIT " . strval($begin * $cantidad) . ", " . strval($cantidad+1);    
          }

          $arrayCuestionarios   = DatabaseManager::multiFetchAssoc($query);
          $cuestionario_simples = array();

          if ($arrayCuestionarios !== NULL)
          {
              $i = 0;
              foreach ($arrayCuestionarios as $cuestionario_simple) 
              {
                  if ($i == $cantidad && $begin >= 0)
                  {
                      continue;
                  }

                  $cuestionarioA = new Cuestionario();
                  $cuestionarioA->fromArray($cuestionario_simple);
                  $cuestionario_simples[] = $cuestionarioA;
                  $i++;
              }

              return $cuestionario_simples;
          }
          else
          {
              return null;
          }
      }
  }

 ?>