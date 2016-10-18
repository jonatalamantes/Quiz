<?php 

	/**
	* 	Clase para un Relacion de Respuesta del alumno
	*/
	class RespuetaAlumno
	{
		private $id;
        private $idAlumno;
        private $idRelacionOpcionPregunta;

		function __construct($i = 0, $a = "", $r = "")
		{
			$this->id                       = $i;
            $this->idAlumno                 = $a;
            $this->idRelacionOpcionPregunta = $r;
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
         * Gets the value of idRelacionOpcionPregunta.
         *
         * @return mixed
         */
        public function getidRelacionOpcionPregunta()
        {
            return $this->idRelacionOpcionPregunta;
        }

        /**
         * Sets the value of idRelacionOpcionPregunta.
         *
         * @param mixed $idRelacionOpcionPregunta the id respuesta
         *
         * @return self
         */
        public function setidRelacionOpcionPregunta($idRelacionOpcionPregunta)
        {
            $this->idRelacionOpcionPregunta = $idRelacionOpcionPregunta;

            return $this;
        }
    }


 ?>