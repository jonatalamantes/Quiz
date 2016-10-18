<?php 

	/**
	* 	Clase para un Pregunta
	*/
	class RelacionCuestionarioCurso
	{
		private $id;
        private $idCuestionario;
        private $idCurso;

		function __construct($i = 0, $o = "", $r = "")
		{
			$this->id             = $i;
            $this->idCuestionario = $o;
            $this->idCurso        = $r;
		}
                
        /**
         * Gets the value of id.
         *
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * Sets the value of id.
         *
         * @param mixed $id the id
         *
         * @return self
         */
        public function setId($id)
        {
            $this->id = $id;

            return $this;
        }

        /**
         * Gets the value of idCuestionario.
         *
         * @return mixed
         */
        public function getIdCuestionario()
        {
            return $this->idCuestionario;
        }

        /**
         * Sets the value of idCuestionario.
         *
         * @param mixed $idCuestionario the id Cuestionario
         *
         * @return self
         */
        public function setIdCuestionario($idCuestionario)
        {
            $this->idCuestionario = $idCuestionario;

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