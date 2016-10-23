<?php 
    
    require_once(__DIR__."/../Classes/RelacionOpcionPregunta.php");
    require_once("DatabaseManager.php");

    /**
    * Class for manipulate RelacionOpcionPregunta Objects
    * 
    * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
    */
    class ControladorRelacionOpcionPregunta
    {
        /**
         * Insert one respuestaOpcion in the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  RelacionOpcionPregunta $respuestaOpcion  The respuestaOpcion to insert
         * @return boolean           If was possible to insert
         */
        static function add($respuestaOpcion = null)
        {
            if ($respuestaOpcion === null)
            {
                return false;
            }

            $opciones = array('idPregunta' => $respuestaOpcion->getIdPregunta(), 
                              'idOpcion'   => $respuestaOpcion->getIdOpcion());

            $singleRelacionOpcionPregunta = self::getSingle($opciones);

            if ($singleRelacionOpcionPregunta == null)
            {
                $idPregunta = $respuestaOpcion->getIdPregunta();
                $idOpcion   = $respuestaOpcion->getIdOpcion();

                $tableRelacionOpcionPregunta = DatabaseManager::getNameTable('TABLE_REL_OPCION_PREGUNTA');

                $query     = "INSERT INTO $tableRelacionOpcionPregunta 
                             (idPregunta, idOpcion) 
                             VALUES 
                             ($idPregunta, $idOpcion)";

                if (DatabaseManager::singleAffectedRow($query) === true)
                {                    
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else //RelacionOpcionPregunta Exist
            {
                return false;
            }
        }

        /**
         * Delete one respuestaOpcion from the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  RelacionOpcionPregunta $respuestaOpcion  The respuestaOpcion to delete
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
                $opciones = array('idPregunta' => $respuestaOpcion->getIdPregunta(), 
                                  'idOpcion'   => $respuestaOpcion->getIdOpcion());

                $singleRelacionOpcionPregunta = self::getSingle($opciones);

                if ($singleRelacionOpcionPregunta != null)
                {
                    $tableRelacionOpcionPregunta  = DatabaseManager::getNameTable('TABLE_REL_OPCION_PREGUNTA');
                    
                    $idPregunta = $respuestaOpcion->getIdPregunta();
                    $idOpcion   = $respuestaOpcion->getIdOpcion();

                    $query     = "DELETE FROM $tableRelacionOpcionPregunta
                                  WHERE idPregunta = $idPregunta AND idOpcion = $idOpcion";
                                    
                    return DatabaseManager::singleAffectedRow($query);
                }
            }
        }

        /**
         * Delete one respuestaOpcion from the database
         * 
         * @author Jonathan Sandoval <jonathan.sandoval@jalisco.gob.mx>
         * @param  RelacionOpcionPregunta $respuestaOpcion  The respuestaOpcion to delete
         * @return boolean           if was possible to delete
         */
        static function update($respuestaOpcion = null)
        {
            if ($respuestaOpcion === null)
            {
                return false;
            }
            else
            {
                $opciones = array('idPregunta' => $respuestaOpcion->getIdPregunta(), 
                                  'idOpcion'   => $respuestaOpcion->getIdOpcion());

                $singleRelacionOpcionPregunta = self::getSingle($opciones);

                if ($singleRelacionOpcionPregunta != null)
                {
                    $tableRelacionOpcionPregunta  = DatabaseManager::getNameTable('TABLE_REL_OPCION_PREGUNTA');
                    
                    $idPregunta = $respuestaOpcion->getIdPregunta();
                    $idOpcion   = $respuestaOpcion->getIdOpcion();
                    $liberada   = $respuestaOpcion->getLiberada();

                    $query     = "UPDATE $tableRelacionOpcionPregunta
                                  SET liberada = '$liberada'
                                  WHERE idPregunta = $idPregunta AND idOpcion = $idOpcion";
                                    
                    return DatabaseManager::singleAffectedRow($query);
                }
            }
        }
    }

 ?>