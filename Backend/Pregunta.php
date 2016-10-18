<?php 

	/**
	* 	Clase para un Pregunta
	*/
	class Pregunta
	{
		private $id;
		private $descripcion;

		function __construct($i = 0, $d = "", $c = "")
		{
			$this->id          = $i;
			$this->descripcion = $d;
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
    }


 ?>