<?php 
    
    require_once(__DIR__."/../Classes/Opcion.php");
    require_once("DatabaseManager.php");

    /**
    * Class for manipulate Opcion Objects
    * 
    * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
    */
    class ControladorOpcion
    {
        /**
         * Recover from database one Opcion object by id
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  string   $key          Key to search
         * @param  string   $value        Value of the key
         * @return Opcion  $opcion_simple  Opcion result or null
         */
        static function getSingle($keysValues = array())
        {
            if (!is_array($keysValues) || !empty($keysValues))
            {
                return null;
            }

            $tableOpcion  = DatabaseManager::getNameTable('TABLE_OPCION');

            $query     = "SELECT $tableOpcion.* 
                          FROM $tableOpcion
                          WHERE ";

            foreach ($keysValues as $key => $value) 
            {
                $query .= "$tableOpcion.$key = $value AND";
            }

            $query = substr($query, 0, strlen($query)-4);

            $opcion_simple = DatabaseManager::singleFetchAssoc($query);
            $opcionA       = new Opcion();
            $opcionA->fromArray($opcion_simple);

            return $opcionA;
        }

        /**
         * Recover all Opcion from the database begin in one part of the opcion_simple table
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  string            $order       The type of sort of the Opcion
         * @param  integer           $begin       The number of page to display the registry
         * @return Array[Opcion]    $opcion_simples    Array of Opcion Object
         */
        static function getAll($order = 'id', $begin = 0, $cantidad = 10)
        {
            $tableOpcion  = DatabaseManager::getNameTable('TABLE_OPCION');

            $query     = "SELECT $tableOpcion.*
                          FROM $tableOpcion
                          WHERE $tableOpcion.activo = 'S'
                          ORDER BY ";

            if ($order == 'descripcion')
            {
                $query = $query . " $tableOpcion.descripcion";
            }
            else if ($order == 'correcta')
            {
                $query = $query . " $tableOpcion.correcta";
            }
            else
            {
                $query = $query . " $tableOpcion.id DESC";
            }

            if ($begin >= 0)
            {
                $query = $query. " LIMIT " . strval($begin * $cantidad) . ", " . strval($cantidad+1);    
            }

            $arrayOpcions   = DatabaseManager::multiFetchAssoc($query);
            $opcion_simples = array();

            if ($arrayOpcions !== NULL)
            {
                $i = 0;
                foreach ($arrayOpcions as $opcion_simple) 
                {
                    if ($i == $cantidad && $begin >= 0)
                    {
                        continue;
                    }

                    $opcionA = new Opcion();
                    $opcionA->fromArray($opcion_simple);
                    $opcion_simples[] = $opcionA;
                    $i++;
                }

                return $opcion_simples;
            }
            else
            {
                return null;
            }
        }

        /**
         * Insert one opcion in the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  Opcion $opcion  The opcion to insert
         * @return boolean           If was possible to insert
         */
        static function add($opcion = null)
        {
            if ($opcion === null)
            {
                return false;
            }

            $opciones = array('descripcion' => $opcion->getDescripcion(), 
                              'correcta'    => $opcion->getCorrecta());

            $singleOpcion = self::getSingle($opciones);

            if ($singleOpcion->disimilitud($opcion) == 1)
            {
                $descripcion     = $opcion->getDescripcion();
                $correcta        = $opcion->getCorrecta();

                $tableOpcion = DatabaseManager::getNameTable('TABLE_OPCION');

                $query     = "INSERT INTO $tableOpcion 
                             (descripcion, correcta) 
                             VALUES 
                             ('$descripcion', '$correcta')";

                if (DatabaseManager::singleAffectedRow($query) === true)
                {                    
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else //Opcion Exist
            {
                return false;
            }
        }

        /**
         * Insert one opcion in the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  Opcion $opcion  The opcion to insert
         * @return boolean           If was possible to insert
         */
        static function update($opcion = NULL)
        {
            if ($opcion === null)
            {
                return false;
            }

            $opciones = array('id' => $opcion->getId());

            $singleOpcion = self::getSingle($opciones);

            if ($singleOpcion->disimilitud($opcion) > 0)
            {
                $id          = $singleOpcion->getId();
                $descripcion = $opcion->getDescripcion();
                $correcta    = $opcion->getCorrecta();

                $tableOpcion = DatabaseManager::getNameTable('TABLE_OPCION');

                $query     = "UPDATE $tableOpcion 
                              SET descripcion = '$descripcion', 
                                  correcta    = '$correcta'
                             WHERE $tableOpcion.id = '$id'";

                if (DatabaseManager::singleAffectedRow($query) === true)
                {                    
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else //Opcion Exist
            {
                return false;
            }
        }

        /**
         * Delete one opcion from the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  Opcion $opcion  The opcion to delete
         * @return boolean           if was possible to delete
         */
        static function remove($opcion = null)
        {
            if ($opcion === null)
            {
                return false;
            }
            else
            {
                $tableOpcion  = DatabaseManager::getNameTable('TABLE_OPCION');
                $id           = $opcion->getId();

                $query     = "UPDATE $tableOpcion
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
        static function simpleSearch($string = '', $order = "id", $begin = 0, $cantidad = 10)
        {
            $tableOpcion  = DatabaseManager::getNameTable('TABLE_OPCION');

            $query     = "SELECT $tableOpcion.*
                          FROM $tableOpcion
                          WHERE ($tableOpcion.descripcion LIKE '%$string%') AND
                                 $tableOpcion.activo = 'S'
                          ORDER BY ";

            if ($order == 'descripcion')
            {
                $query = $query . " $tableOpcion.descripcion";
            }
            else if ($order == 'correcta')
            {
                $query = $query . " $tableOpcion.correcta";
            }
            else
            {
                $query = $query . " $tableOpcion.id DESC";
            }

            if ($begin >= 0)
            {
                $query = $query. " LIMIT " . strval($begin * $cantidad) . ", " . strval($cantidad+1);    
            }

            $arrayOpcions   = DatabaseManager::multiFetchAssoc($query);
            $opcion_simples = array();

            if ($arrayOpcions !== NULL)
            {
                $i = 0;
                foreach ($arrayOpcions as $opcion_simple) 
                {
                    if ($i == $cantidad && $begin >= 0)
                    {
                        continue;
                    }

                    $opcionA = new Opcion();
                    $opcionA->fromArray($opcion_simple);
                    $opcion_simples[] = $opcionA;
                    $i++;
                }

                return $opcion_simples;
            }
            else
            {
                return null;
            }
        }

      /**
       * Recover from database one Opcion object by id
       * 
       * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
       * @param  string   $key          Key to search
       * @param  string   $value        Value of the key
       * @return Opcion  $opcion_simple  Opcion result or null
       */
      static function filter($keysValues = array(), $order = 'id', $begin = 0, $cantidad = 10)
      {
          if (!is_array($keysValues) || !empty($keysValues))
          {
              return null;
          }

          $tableOpcion  = DatabaseManager::getNameTable('TABLE_OPCION');

          $query     = "SELECT $tableOpcion.* 
                        FROM $tableOpcion
                        WHERE ";

          foreach ($keysValues as $key => $value) 
          {
              $query .= "$tableOpcion.$key = $value AND";
          }

          $query = substr($query, 0, strlen($query)-4);

          if ($order == 'descripcion')
          {
              $query = $query . " $tableOpcion.descripcion";
          }
          else if ($order == 'correcta')
          {
              $query = $query . " $tableOpcion.correcta";
          }
          else
          {
              $query = $query . " $tableOpcion.id DESC";
          }

          if ($begin >= 0)
          {
              $query = $query. " LIMIT " . strval($begin * $cantidad) . ", " . strval($cantidad+1);    
          }

          $arrayOpcions   = DatabaseManager::multiFetchAssoc($query);
          $opcion_simples = array();

          if ($arrayOpcions !== NULL)
          {
              $i = 0;
              foreach ($arrayOpcions as $opcion_simple) 
              {
                  if ($i == $cantidad && $begin >= 0)
                  {
                      continue;
                  }

                  $opcionA = new Opcion();
                  $opcionA->fromArray($opcion_simple);
                  $opcion_simples[] = $opcionA;
                  $i++;
              }

              return $opcion_simples;
          }
          else
          {
              return null;
          }
      }
  }

 ?>