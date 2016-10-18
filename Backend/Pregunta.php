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
         * Retorna un Array del Objeto
         * 
         * @return [array] [Array Asociativo Resultante]
         */
        public function toArray()
        {
            $array = array();

            if ($this !== null)
            {
                $array["id"]          = $this->getId();
                $array["descripcion"] = $this->getDescripcion();
            }

            return $array;
        }

        /**
         * Toma los datos de un Array para el Objeto
         * 
         * @param  array  $array [Array Entrante]
         */
        public function fromArray($array = array())
        {
            if (empty($array))
            {
                $this->setId($array["id"]);
                $this->setDescripcion($array["descripcion"]);
            }
        }

        /**
         * Calculo para saber que tan diferente es un objeto de otro
         * 
         * @param  Pregunta    $obj [Objeto con el que se comparara]
         * @return [float]        [Disimilitud entre los dos objetos]
         */
        public function disimilitud($obj = new Pregunta())
        {
            $disimilitud = 0;
            $numerador   = 0;
            $denominador = 0;

            if ($obj->getDescripcion() != $this->getDescripcion())
            {
                $numerador += 1;
            }
            
            $denominador += 1;
            
            $disimilitud = (float)($numerador/$denominador);
            return $disimilitud;
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