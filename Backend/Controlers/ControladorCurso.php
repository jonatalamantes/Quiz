<?php 
    
    require_once(__DIR__."/../Classes/Curso.php");
    require_once("DatabaseManager.php");

    /**
    * Class for manipulate Curso Objects
    * 
    * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
    */
    class ControladorCurso
    {
        /**
         * Recover from database one Curso object by id
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

            $tableCurso  = DatabaseManager::getNameTable('TABLE_CURSO');

            $query     = "SELECT $tableCurso.* 
                          FROM $tableCurso
                          WHERE ";

            foreach ($keysValues as $key => $value) 
            {
                $query .= "$tableCurso.$key = '$value' AND ";
            }

            $query = substr($query, 0, strlen($query)-4);

            $curso_simple = DatabaseManager::singleFetchAssoc($query);
            
            if ($curso_simple !== NULL)
            {
                $cursoA = new Curso();
                $cursoA->fromArray($curso_simple);
            }

            return $cursoA;
        }

        /**
         * Recover all Curso from the database begin in one part of the curso_simple table
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  string            $order       The type of sort of the Curso
         * @param  integer           $begin       The number of page to display the registry
         * @return Array[Curso]    $curso_simples    Array of Curso Object
         */
        static function getAll($order = 'id', $begin = 0, $cantidad = 10)
        {
            $tableCurso  = DatabaseManager::getNameTable('TABLE_CURSO');

            $query     = "SELECT $tableCurso.*
                          FROM $tableCurso
                          WHERE $tableCurso.activo = 'S'
                          ORDER BY ";

            if ($order == 'nombre')
            {
                $query = $query . " $tableCurso.nombre";
            }
            else if ($order == 'ciclo')
            {
                $query = $query . " $tableCurso.ciclo";
            }
            else
            {
                $query = $query . " $tableCurso.id DESC";
            }

            if ($begin >= 0)
            {
                $query = $query. " LIMIT " . strval($begin * $cantidad) . ", " . strval($cantidad+1);    
            }

            $arrayCursos   = DatabaseManager::multiFetchAssoc($query);
            $curso_simples = array();

            if ($arrayCursos !== NULL)
            {
                $i = 0;
                foreach ($arrayCursos as $curso_simple) 
                {
                    if ($i == $cantidad && $begin >= 0)
                    {
                        continue;
                    }

                    $cursoA = new Curso();
                    $cursoA->fromArray($curso_simple);
                    $curso_simples[] = $cursoA;
                    $i++;
                }

                return $curso_simples;
            }
            else
            {
                return null;
            }
        }

        /**
         * Insert one curso in the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  Curso $curso  The curso to insert
         * @return boolean           If was possible to insert
         */
        static function add($curso = null)
        {
            if ($curso === null)
            {
                return false;
            }

            $opciones = array('nombre' => $curso->getNombre(), 
                              'ciclo'  => $curso->getCiclo());

            $singleCurso = self::getSingle($opciones);

            if ($singleCurso == NULL || $singleCurso->disimilitud($curso) == 1)
            {
                $nombre = $curso->getNombre();
                $ciclo  = $curso->getCiclo();

                $tableCurso = DatabaseManager::getNameTable('TABLE_CURSO');

                $query     = "INSERT INTO $tableCurso 
                             (nombre, ciclo) 
                             VALUES 
                             ('$nombre', '$ciclo')";

                if (DatabaseManager::singleAffectedRow($query) === true)
                {                    
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else //Curso Exist
            {
                return false;
            }
        }

        /**
         * Insert one curso in the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  Curso $curso  The curso to insert
         * @return boolean           If was possible to insert
         */
        static function update($curso = NULL)
        {
            if ($curso === null)
            {
                return false;
            }

            $opciones = array('id' => $curso->getId());

            $singleCurso = self::getSingle($opciones);

            if ($singleCurso->disimilitud($curso) > 0)
            {
                $id     = $singleCurso->getId();
                $nombre = $curso->getNombre();
                $ciclo  = $curso->getCiclo();

                $opciones = array('nombre' => $curso->getNombre(), 
                                  'ciclo'  => $curso->getCiclo());

                $singleCurso = self::getSingle($opciones);

                if ($singleCurso == NULL || $singleCurso->disimilitud($curso) == 1)
                {
                    $tableCurso = DatabaseManager::getNameTable('TABLE_CURSO');

                    $query     = "UPDATE $tableCurso 
                                  SET nombre = '$nombre', 
                                      ciclo  = '$ciclo'
                                 WHERE $tableCurso.id = '$id'";

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
            else //Curso Exist
            {
                return false;
            }
        }

        /**
         * Delete one curso from the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  Curso $curso  The curso to delete
         * @return boolean           if was possible to delete
         */
        static function remove($curso = null)
        {
            if ($curso === null)
            {
                return false;
            }
            else
            {
                $tableCurso  = DatabaseManager::getNameTable('TABLE_CURSO');
                $id           = $curso->getId();

                $query     = "UPDATE $tableCurso
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
            $tableCurso  = DatabaseManager::getNameTable('TABLE_CURSO');

            $query     = "SELECT $tableCurso.*
                          FROM $tableCurso
                          WHERE ($tableCurso.nombre LIKE '%$string%'   OR 
                                 $tableCurso.ciclo  LIKE '%$string%' ) AND
                                 $tableCurso.activo = 'S'
                          ORDER BY ";

            if ($order == 'nombre')
            {
                $query = $query . " $tableCurso.nombre";
            }
            else if ($order == 'ciclo')
            {
                $query = $query . " $tableCurso.ciclo";
            }
            else
            {
                $query = $query . " $tableCurso.id DESC";
            }

            if ($begin >= 0)
            {
                $query = $query. " LIMIT " . strval($begin * $cantidad) . ", " . strval($cantidad+1);    
            }

            $arrayCursos   = DatabaseManager::multiFetchAssoc($query);
            $curso_simples = array();

            if ($arrayCursos !== NULL)
            {
                $i = 0;
                foreach ($arrayCursos as $curso_simple) 
                {
                    if ($i == $cantidad && $begin >= 0)
                    {
                        continue;
                    }

                    $cursoA = new Curso();
                    $cursoA->fromArray($curso_simple);
                    $curso_simples[] = $cursoA;
                    $i++;
                }

                return $curso_simples;
            }
            else
            {
                return null;
            }
        }

      /**
       * Recover from database one Curso object by id
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

          $tableCurso  = DatabaseManager::getNameTable('TABLE_CURSO');

          $query     = "SELECT $tableCurso.* 
                        FROM $tableCurso
                        WHERE ";

          foreach ($keysValues as $key => $value) 
          {
              $query .= "$tableCurso.$key LIKE '%$value%' AND ";
          }

          $query = substr($query, 0, strlen($query)-4);
          $query .= " ORDER BY ";

          if ($order == 'nombre')
          {
              $query = $query . " $tableCurso.nombre";
          }
          else if ($order == 'ciclo')
          {
              $query = $query . " $tableCurso.ciclo";
          }
          else
          {
              $query = $query . " $tableCurso.id DESC";
          }

          if ($begin >= 0)
          {
              $query = $query. " LIMIT " . strval($begin * $cantidad) . ", " . strval($cantidad+1);    
          }

          $arrayCursos   = DatabaseManager::multiFetchAssoc($query);
          $curso_simples = array();

          if ($arrayCursos !== NULL)
          {
              $i = 0;
              foreach ($arrayCursos as $curso_simple) 
              {
                  if ($i == $cantidad && $begin >= 0)
                  {
                      continue;
                  }

                  $cursoA = new Curso();
                  $cursoA->fromArray($curso_simple);
                  $curso_simples[] = $cursoA;
                  $i++;
              }

              return $curso_simples;
          }
          else
          {
              return null;
          }
      }
  }

 ?>