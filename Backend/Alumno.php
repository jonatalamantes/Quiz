<?php 

	/**
	* 	Clase para un Alumno
	*/
	class Alumno
	{
		private $id;
		private $nombres;
		private $apellidoMaterno;
		private $apellidoPaterno;
		private $idCurso;

		function __construct($i = 0, $n = "", $ap = "", $am = "", $c = 0)
		{
			$this->id              = $i;
			$this->nombres         = $n;
			$this->apellidoPaterno = $ap;
			$this->apellidoMaterno = $am;
			$this->idCurso         = $c;
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
         * Gets the value of nombres.
         *
         * @return mixed
         */
        public function getNombres()
        {
            return $this->nombres;
        }

        /**
         * Sets the value of nombres.
         *
         * @param mixed $nombres the nombres
         *
         * @return self
         */
        public function setNombres($nombres)
        {
            $this->nombres = $nombres;

            return $this;
        }

        /**
         * Gets the value of apellidoMaterno.
         *
         * @return mixed
         */
        public function getApellidoMaterno()
        {
            return $this->apellidoMaterno;
        }

        /**
         * Sets the value of apellidoMaterno.
         *
         * @param mixed $apellidoMaterno the apellido materno
         *
         * @return self
         */
        public function setApellidoMaterno($apellidoMaterno)
        {
            $this->apellidoMaterno = $apellidoMaterno;

            return $this;
        }

        /**
         * Gets the value of apellidoPaterno.
         *
         * @return mixed
         */
        public function getApellidoPaterno()
        {
            return $this->apellidoPaterno;
        }

        /**
         * Sets the value of apellidoPaterno.
         *
         * @param mixed $apellidoPaterno the apellido paterno
         *
         * @return self
         */
        public function setApellidoPaterno($apellidoPaterno)
        {
            $this->apellidoPaterno = $apellidoPaterno;

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
         * @param mixed $idCurso the id curso
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