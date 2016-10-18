<?php 

	/**
	* 	Clase para un Curso
	*/
	class Curso
	{
		private $id;
		private $nombre;
		private $ciclo;

		function __construct($i = 0, $n = "", $c = "")
		{
			$this->id     = $i;
			$this->nombre = $n;
			$this->ciclo  = $c;
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
                $array["id"]     = $this->getId();
                $array["nombre"] = $this->getNombre();
                $array["ciclo"]  = $this->getCiclo();
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
                $this->setNombre($array["nombre"]);
                $this->setCiclo($array["ciclo"]);
            }
        }

        /**
         * Calculo para saber que tan diferente es un objeto de otro
         * 
         * @param  Curso    $obj [Objeto con el que se comparara]
         * @return [float]       [Disimilitud entre los dos objetos]
         */
        public function disimilitud($obj = new Curso())
        {
            $disimilitud = 0;
            $numerador   = 0;
            $denominador = 0;

            if ($obj->getNombre() != $this->getNombre())
            {
                $numerador += 1;
            }
            
            $denominador += 1;
            
            if ($obj->getCiclo() != $this->getCiclo())
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
         * Gets the value of nombre.
         *
         * @return mixed
         */
        public function getNombre()
        {
            return $this->nombre;
        }

        /**
         * Sets the value of nombre.
         *
         * @param mixed $nombre the nombre
         *
         * @return self
         */
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;

            return $this;
        }

        /**
         * Gets the value of ciclo.
         *
         * @return mixed
         */
        public function getCiclo()
        {
            return $this->ciclo;
        }

        /**
         * Sets the value of ciclo.
         *
         * @param mixed $ciclo the ciclo
         *
         * @return self
         */
        public function setCiclo($ciclo)
        {
            $this->ciclo = $ciclo;

            return $this;
        }
    }


 ?>