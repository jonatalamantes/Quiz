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
    }

 ?>