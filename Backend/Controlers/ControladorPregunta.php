<?php 
    
    require_once(__DIR__."/../Classes/Pregunta.php");
    require_once("DatabaseManager.php");

    /**
    * Class for manipulate Pregunta Objects
    * 
    * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
    */
    class ControladorPregunta
    {
        /**
         * Recover from database one Pregunta object by id
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  string   $key          Key to search
         * @param  string   $value        Value of the key
         * @return Pregunta  $pregunta_simple  Pregunta result or null
         */
        static function getSingle($keysValues = array())
        {
            if (!is_array($keysValues) || !empty($keysValues))
            {
                return null;
            }

            $tablePregunta  = DatabaseManager::getNameTable('TABLE_PREGUNTA');

            $query     = "SELECT $tablePregunta.* 
                          FROM $tablePregunta
                          WHERE $tablePregunta.activo = 'S' AND ";

            foreach ($keysValues as $key => $value) 
            {
                $query .= "$tablePregunta.$key = '$value' AND ";
            }

            $query = substr($query, 0, strlen($query)-4);

            $pregunta_simple = DatabaseManager::singleFetchAssoc($query);
            
            if ($pregunta_simple !== NULL)
            {
                $preguntaA = new Pregunta();
                $preguntaA->fromArray($pregunta_simple);
            }

            return $preguntaA;
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
            $tablePregunta  = DatabaseManager::getNameTable('TABLE_PREGUNTA');

            $query     = "SELECT $tablePregunta.* 
                          FROM $tablePregunta
                          ORDER BY id DESC";

            $pregunta_simple = DatabaseManager::singleFetchAssoc($query);
            
            if ($pregunta_simple !== NULL)
            {
                $preguntaA = new Pregunta();
                $preguntaA->fromArray($pregunta_simple);
            }

            return $preguntaA;
        }

        /**
         * Recover all Pregunta from the database begin in one part of the pregunta_simple table
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  string            $order       The type of sort of the Pregunta
         * @param  integer           $begin       The number of page to display the registry
         * @return Array[Pregunta]    $pregunta_simples    Array of Pregunta Object
         */
        static function getAll($order = 'id', $begin = 0, $cantidad = 10)
        {
            $tablePregunta  = DatabaseManager::getNameTable('TABLE_PREGUNTA');

            $query     = "SELECT $tablePregunta.*
                          FROM $tablePregunta
                          WHERE $tablePregunta.activo = 'S'
                          ORDER BY ";

            if ($order == 'descripcion')
            {
                $query = $query . " $tablePregunta.descripcion";
            }
            else
            {
                $query = $query . " $tablePregunta.id DESC";
            }

            if ($begin >= 0)
            {
                $query = $query. " LIMIT " . strval($begin * $cantidad) . ", " . strval($cantidad+1);    
            }

            $arrayPreguntas   = DatabaseManager::multiFetchAssoc($query);
            $pregunta_simples = array();

            if ($arrayPreguntas !== NULL)
            {
                $i = 0;
                foreach ($arrayPreguntas as $pregunta_simple) 
                {
                    if ($i == $cantidad && $begin >= 0)
                    {
                        continue;
                    }

                    $preguntaA = new Pregunta();
                    $preguntaA->fromArray($pregunta_simple);
                    $pregunta_simples[] = $preguntaA;
                    $i++;
                }

                return $pregunta_simples;
            }
            else
            {
                return null;
            }
        }

        /**
         * Insert one pregunta in the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  Pregunta $pregunta  The pregunta to insert
         * @return boolean           If was possible to insert
         */
        static function add($pregunta = null)
        {
            if ($pregunta === null)
            {
                return false;
            }

            $opciones = array('descripcion' => $pregunta->getDescripcion());

            $singlePregunta = self::getSingle($opciones);

            if ($singlePregunta === null || $singlePregunta->disimilitud($pregunta) == 1)
            {
                $descripcion     = $pregunta->getDescripcion();

                $tablePregunta = DatabaseManager::getNameTable('TABLE_PREGUNTA');

                $query     = "INSERT INTO $tablePregunta 
                             (descripcion) 
                             VALUES 
                             ('$descripcion')";

                if (DatabaseManager::singleAffectedRow($query) === true)
                {                    
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else //Pregunta Exist
            {
                return false;
            }
        }

        /**
         * Insert one pregunta in the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  Pregunta $pregunta  The pregunta to insert
         * @return boolean           If was possible to insert
         */
        static function update($pregunta = NULL)
        {
            if ($pregunta === null)
            {
                return false;
            }

            $opciones = array('id' => $pregunta->getId());

            $singlePregunta = self::getSingle($opciones);

            if ($singlePregunta->disimilitud($pregunta) > 0)
            {
                $opciones = array('descripcion' => $pregunta->getDescripcion());

                $singlePregunta = self::getSingle($opciones);
    
                if ($singlePregunta->disimilitud($pregunta) == 1)
                {
                    $id          = $singlePregunta->getId();
                    $descripcion = $pregunta->getDescripcion();

                    $tablePregunta = DatabaseManager::getNameTable('TABLE_PREGUNTA');

                    $query     = "UPDATE $tablePregunta 
                                  SET descripcion = '$descripcion'
                                  WHERE $tablePregunta.id = '$id'";

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
            else //Pregunta Exist
            {
                return false;
            }
        }

        /**
         * Delete one pregunta from the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  Pregunta $pregunta  The pregunta to delete
         * @return boolean           if was possible to delete
         */
        static function remove($pregunta = null)
        {
            if ($pregunta === null)
            {
                return false;
            }
            else
            {
                $tablePregunta  = DatabaseManager::getNameTable('TABLE_PREGUNTA');
                $id           = $pregunta->getId();

                $query     = "UPDATE $tablePregunta
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
            $tablePregunta  = DatabaseManager::getNameTable('TABLE_PREGUNTA');

            $query     = "SELECT $tablePregunta.*
                          FROM $tablePregunta
                          WHERE ($tablePregunta.descripcion LIKE '%$string%') AND
                                 $tablePregunta.activo = 'S'
                          ORDER BY ";

            if ($order == 'descripcion')
            {
                $query = $query . " $tablePregunta.descripcion";
            }
            else
            {
                $query = $query . " $tablePregunta.id DESC";
            }

            if ($begin >= 0)
            {
                $query = $query. " LIMIT " . strval($begin * $cantidad) . ", " . strval($cantidad+1);    
            }

            $arrayPreguntas   = DatabaseManager::multiFetchAssoc($query);
            $pregunta_simples = array();

            if ($arrayPreguntas !== NULL)
            {
                $i = 0;
                foreach ($arrayPreguntas as $pregunta_simple) 
                {
                    if ($i == $cantidad && $begin >= 0)
                    {
                        continue;
                    }

                    $preguntaA = new Pregunta();
                    $preguntaA->fromArray($pregunta_simple);
                    $pregunta_simples[] = $preguntaA;
                    $i++;
                }

                return $pregunta_simples;
            }
            else
            {
                return null;
            }
        }

      /**
       * Recover from database one Pregunta object by id
       * 
       * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
       * @param  string   $key          Key to search
       * @param  string   $value        Value of the key
       * @return Pregunta  $pregunta_simple  Pregunta result or null
       */
      static function filter($keysValues = array(), $order = 'id', $begin = 0, $cantidad = 10)
      {
          if (!is_array($keysValues) || empty($keysValues))
          {
              return null;
          }

          $tablePregunta  = DatabaseManager::getNameTable('TABLE_PREGUNTA');

          $query     = "SELECT $tablePregunta.* 
                        FROM $tablePregunta
                        WHERE ";

          foreach ($keysValues as $key => $value) 
          {
              $query .= "$tablePregunta.$key LIKE '%$value%' AND ";
          }

          $query = substr($query, 0, strlen($query)-4);
          $query .= " ORDER BY ";

          if ($order == 'descripcion')
          {
              $query = $query . " $tablePregunta.descripcion";
          }
          else
          {
              $query = $query . " $tablePregunta.id DESC";
          }

          if ($begin >= 0)
          {
              $query = $query. " LIMIT " . strval($begin * $cantidad) . ", " . strval($cantidad+1);    
          }

          $arrayPreguntas   = DatabaseManager::multiFetchAssoc($query);
          $pregunta_simples = array();

          if ($arrayPreguntas !== NULL)
          {
              $i = 0;
              foreach ($arrayPreguntas as $pregunta_simple) 
              {
                  if ($i == $cantidad && $begin >= 0)
                  {
                      continue;
                  }

                  $preguntaA = new Pregunta();
                  $preguntaA->fromArray($pregunta_simple);
                  $pregunta_simples[] = $preguntaA;
                  $i++;
              }

              return $pregunta_simples;
          }
          else
          {
              return null;
          }
      }
  }

 ?>