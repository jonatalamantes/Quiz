<?php 

	/**
	* 	Clase para un Cuestionario
	*/
	class Cuestionario
	{
		private $id;
        private $numero;
		private $idRelacionOpcionPregunta;
        private $activo;
        private $fechaRegistro;        

		function __construct($i = 0, $n = "", $r = 0, $a = "S", $f = "")
		{
			$this->id                       = $i;
            $this->numero                   = $n;
            $this->idRelacionOpcionPregunta = $r;
            $this->activo                   = $a;
            $this->fechaRegistro            = $f;
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
                $array["activo"]                    = $this->getActivo();
                $array["fechaRegistro"]             = $this->getFechaRegistro();                
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
                $this->setActivo($array["activo"]);
                $this->setFechaRegistro($array["fechaRegistro"]);                                                
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
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @return mixed
        */
        public function getId()
        {
            return $this->id;
        }
         
        /**
        * Sets the value of id.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @param mixed $id the id
        *
        * @return self
        */
        public function setId($id)
        {
            $this->id = $id;
        }
     
        /**
        * Gets the value of numero.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @return mixed
        */
        public function getNumero()
        {
            return $this->numero;
        }
         
        /**
        * Sets the value of numero.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @param mixed $numero the numero
        *
        * @return self
        */
        public function setNumero($numero)
        {
            $this->numero = $numero;
        }
     
        /**
        * Gets the value of idRelacionOpcionPregunta.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @return mixed
        */
        public function getIdRelacionOpcionPregunta()
        {
            return $this->idRelacionOpcionPregunta;
        }
         
        /**
        * Sets the value of idRelacionOpcionPregunta.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @param mixed $idRelacionOpcionPregunta the id relacion opcion pregunta
        *
        * @return self
        */
        public function setIdRelacionOpcionPregunta($idRelacionOpcionPregunta)
        {
            $this->idRelacionOpcionPregunta = $idRelacionOpcionPregunta;
        }
     
        /**
        * Gets the value of activo.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @return mixed
        */
        public function getActivo()
        {
            return $this->activo;
        }
         
        /**
        * Sets the value of activo.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @param mixed $activo the activo
        *
        * @return self
        */
        public function setActivo($activo)
        {
            $this->activo = $activo;
        }
     
        /**
        * Gets the value of fechaRegistro.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @return mixed
        */
        public function getFechaRegistro()
        {
            return $this->fechaRegistro;
        }
         
        /**
        * Sets the value of fechaRegistro.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @param mixed $fechaRegistro the fecha registro
        *
        * @return self
        */
        public function setFechaRegistro($fechaRegistro)
        {
            $this->fechaRegistro = $fechaRegistro;
        }
    }

 ?>