<?php 

	/**
	* 	Clase para un Opcion
	*/
	class Opcion
	{
		private $id;
		private $descripcion;
		private $correcta;
        private $activo;
        private $fechaRegistro;

		function __construct($i = 0, $d = "", $c = "", $a = "S", $f = "")
		{
			$this->id            = $i;
			$this->descripcion   = $d;
			$this->correcta      = $c;
            $this->activo        = $a;
            $this->fechaRegistro = $f;
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
                $array["id"]            = $this->getId();
                $array["descripcion"]   = $this->getDescripcion();
                $array["correcta"]      = $this->getCorrecta();
                $array["activo"]        = $this->getActivo();
                $array["fechaRegistro"] = $this->getFechaRegistro();
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
            if (!empty($array))
            {
                $this->setId($array["id"]);
                $this->setDescripcion($array["descripcion"]);
                $this->setCorrecta($array["correcta"]);
                $this->setActivo($array["activo"]);
                $this->setFechaRegistro($array["fechaRegistro"]);                
            }
        }

        /**
         * Calculo para saber que tan diferente es un objeto de otro
         * 
         * @param  Opcion    $obj [Objeto con el que se comparara]
         * @return [float]        [Disimilitud entre los dos objetos]
         */
        public function disimilitud($obj = null)
        {
            if ($obj === null)
            {
                return -1;
            }

            $disimilitud = 0;
            $numerador   = 0;
            $denominador = 0;

            if ($obj->getDescripcion() != $this->getDescripcion())
            {
                $numerador += 1;
            }
            
            $denominador += 1;
            
            if ($obj->getCorrecta() != $this->getCorrecta())
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
        * Gets the value of descripcion.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @return mixed
        */
        public function getDescripcion()
        {
            return $this->descripcion;
        }
         
        /**
        * Sets the value of descripcion.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @param mixed $descripcion the descripcion
        *
        * @return self
        */
        public function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }
     
        /**
        * Gets the value of correcta.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @return mixed
        */
        public function getCorrecta()
        {
            return $this->correcta;
        }
         
        /**
        * Sets the value of correcta.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @param mixed $correcta the correcta
        *
        * @return self
        */
        public function setCorrecta($correcta)
        {
            $this->correcta = $correcta;
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