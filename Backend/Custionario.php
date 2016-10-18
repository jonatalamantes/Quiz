<?php 

	/**
	* 	Clase para un Cuestionario
	*/
	class Cuestionario
	{
		private $id;
        private $numero;
		private $idRelacionOpcionPregunta;

		function __construct($i = 0, $n = "", $r = 0)
		{
			$this->id                       = $i;
            $this->numero                   = $n;
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
         * Gets the value of numero.
         *
         * @return mixed
         */
        public function getNumero()
        {
            return $this->numero;
        }

        /**
         * Sets the value of numero.
         *
         * @param mixed $numero the numero
         *
         * @return self
         */
        public function setNumero($numero)
        {
            $this->numero = $numero;

            return $this;
        }

        /**
         * Gets the value of idRelacionOpcionPregunta.
         *
         * @return mixed
         */
        public function getIdRelacionOpcionPregunta()
        {
            return $this->idRelacionOpcionPregunta;
        }

        /**
         * Sets the value of idRelacionOpcionPregunta.
         *
         * @param mixed $idRelacionOpcionPregunta the id relacion pregunta respuesta
         *
         * @return self
         */
        public function setIdRelacionOpcionPregunta($idRelacionOpcionPregunta)
        {
            $this->idRelacionOpcionPregunta = $idRelacionOpcionPregunta;

            return $this;
        }
    }

 ?>