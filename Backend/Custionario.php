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
         * Retorna un Array del Objeto
         * 
         * @return [array] [Array Asociativo Resultante]
         */
        public function toArray()
        {
            $array = array();

            if ($this !== null)
            {
                $array["id"]                        = $this->getId();
                $array["numero"]                    = $this->getNumero();
                $array["idRelacionOpcionPregunta"]  = $this->getIdRelacionOpcionPregunta();
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
                $this->setNumero($array["numero"]);
                $this->setIdRelacionOpcionPregunta($array["idRelacionOpcionPregunta"]);
            }
        }

        /**
         * Calculo para saber que tan diferente es un objeto de otro
         * 
         * @param  Cuestionario    $obj [Objeto con el que se comparara]
         * @return [float]              [Disimilitud entre los dos objetos]
         */
        public function disimilitud($obj = new Cuestionario())
        {
            $disimilitud = 0;
            $numerador   = 0;
            $denominador = 0;

            if ($obj->getNumero() != $this->getNumero())
            {
                $numerador += 1;
            }
            
            $denominador += 1;
            
            if ($obj->getIdRelacionOpcionPregunta() != $this->getIdRelacionOpcionPregunta())
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