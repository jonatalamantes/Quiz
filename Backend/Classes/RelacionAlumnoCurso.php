<?php 

    /**
    *   Clase para un Pregunta
    */
    class RelacionAlumnoCurso
    {
        private $idAlumno;
        private $idCurso;

        function __construct($i = 0, $o = "", $r = "")
        {
            $this->idAlumno = $o;
            $this->idCurso  = $r;
        }
        
        /**
         * Gets the value of idAlumno.
         *
         * @return mixed
         */
        public function getIdAlumno()
        {
            return $this->idAlumno;
        }

        /**
         * Sets the value of idAlumno.
         *
         * @param mixed $idAlumno the id Alumno
         *
         * @return self
         */
        public function setIdAlumno($idAlumno)
        {
            $this->idAlumno = $idAlumno;

            return $this;
        }

        /**
         * Gets the value of idCurso.
         *
         * @return mixed
         */
        public function getIdCurso()
        {
            return $this->idCurso;
        }

        /**
         * Sets the value of idCurso.
         *
         * @param mixed $idCurso the id Curso
         *
         * @return self
         */
        public function setIdCurso($idCurso)
        {
            $this->idCurso = $idCurso;

            return $this;
        }
    }


 ?>