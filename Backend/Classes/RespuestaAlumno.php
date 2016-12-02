<?php 

	/**
	* 	Clase para un Relacion de Respuesta del alumno
	*/
	class RespuestaAlumno
	{
        private $idAlumno;
        private $idNodoCuestionario;

		function __construct($a = "", $r = "")
		{
            $this->idAlumno           = $a;
            $this->idNodoCuestionario = $r;
		}

        function fromArray($array = null)
        {
            if ($array !== NULL && !empty($array))
            {
                $this->idAlumno           = $array["idAlumno"];
                $this->idNodoCuestionario = $array["idNodoCuestionario"];
            }
        }
                
        /**
         * Gets the value of idAlumno.
         *
         * @return mixed
         */
        public function getidAlumno()
        {
            return $this->idAlumno;
        }

        /**
         * Sets the value of idAlumno.
         *
         * @param mixed $idAlumno the id opcion
         *
         * @return self
         */
        public function setidAlumno($idAlumno)
        {
            $this->idAlumno = $idAlumno;

            return $this;
        }

        /**
         * Gets the value of idNodoCuestionario.
         *
         * @return mixed
         */
        public function getidNodoCuestionario()
        {
            return $this->idNodoCuestionario;
        }

        /**
         * Sets the value of idNodoCuestionario.
         *
         * @param mixed $idNodoCuestionario the id respuesta
         *
         * @return self
         */
        public function setidNodoCuestionario($idNodoCuestionario)
        {
            $this->idNodoCuestionario = $idNodoCuestionario;

            return $this;
        }
    }


 ?>