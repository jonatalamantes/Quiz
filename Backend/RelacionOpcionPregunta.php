<?php 

	/**
	* 	Clase para un Pregunta
	*/
	class RelacionOpcionPregunta
	{
		private $id;
        private $idOpcion;
        private $idOpcion;
		private $liberada;

		function __construct($i = 0, $o = "", $r = "", $l = false)
		{
			$this->id       = $i;
            $this->idOpcion = $o;
            $this->idOpcion = $r;
			$this->liberada = $l;
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
         * Gets the value of idOpcion.
         *
         * @return mixed
         */
        public function getIdOpcion()
        {
            return $this->idOpcion;
        }

        /**
         * Sets the value of idOpcion.
         *
         * @param mixed $idOpcion the id opcion
         *
         * @return self
         */
        public function setIdOpcion($idOpcion)
        {
            $this->idOpcion = $idOpcion;

            return $this;
        }

        /**
         * Gets the value of idOpcion.
         *
         * @return mixed
         */
        public function getIdOpcion()
        {
            return $this->idOpcion;
        }

        /**
         * Sets the value of idOpcion.
         *
         * @param mixed $idOpcion the id Opcion
         *
         * @return self
         */
        public function setIdOpcion($idOpcion)
        {
            $this->idOpcion = $idOpcion;

            return $this;
        }

        /**
         * Gets the value of liberada.
         *
         * @return mixed
         */
        public function getLiberada()
        {
            return $this->liberada;
        }

        /**
         * Sets the value of liberada.
         *
         * @param mixed $liberada the liberada
         *
         * @return self
         */
        public function setLiberada($liberada)
        {
            $this->liberada = $liberada;

            return $this;
        }
    }


 ?>