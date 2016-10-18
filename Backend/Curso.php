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