<?php 

	/**
	* 	Clase para un Opcion
	*/
	class Opcion
	{
		private $id;
		private $descripcion;
		private $correcta;

		function __construct($i = 0, $d = "", $c = "")
		{
			$this->id          = $i;
			$this->descripcion = $d;
			$this->correcta    = $c;
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
         * Gets the value of descripcion.
         *
         * @return mixed
         */
        public function getDescripcion()
        {
            return $this->descripcion;
        }

        /**
         * Sets the value of descripcion.
         *
         * @param mixed $descripcion the descripcion
         *
         * @return self
         */
        public function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;

            return $this;
        }

        /**
         * Gets the value of correcta.
         *
         * @return mixed
         */
        public function getCorrecta()
        {
            return $this->correcta;
        }

        /**
         * Sets the value of correcta.
         *
         * @param mixed $correcta the correcta
         *
         * @return self
         */
        public function setCorrecta($correcta)
        {
            $this->correcta = $correcta;

            return $this;
        }
    }


 ?>