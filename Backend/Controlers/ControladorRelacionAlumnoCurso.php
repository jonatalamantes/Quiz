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
        static function add($respuestaAlumno = null)
        {
            if ($respuestaAlumno === null)
            {
                return false;
            }

            $opciones = array('idCurso'  => $respuestaAlumno->getIdCurso(), 
                              'idAlumno' => $respuestaAlumno->getIdAlumno());

            $singleRelacionAlumnoCurso = self::getSingle($opciones);

            if ($singleRelacionAlumnoCurso == null)
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
    }

 ?>