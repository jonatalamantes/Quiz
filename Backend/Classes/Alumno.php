<?php 

	/**
	* 	Clase para un Alumno
	*/
	class Alumno
	{
		private $id;
		private $nombres;
		private $apellidoMaterno;
		private $apellidoPaterno;
        private $activo;
        private $fechaRegistro;

        /**
         * Constructor de la Clase
         * 
         * @param integer $i  [id]
         * @param string  $n  [nombres]
         * @param string  $ap [apellidoPaterno]
         * @param string  $am [apellidoMaterno]
         */
        function __construct($i = 0, $n = "", $ap = "", $am = "", $a = "S", $f = "")
        {
            $this->id              = $i;
            $this->nombres         = $n;
            $this->apellidoPaterno = $ap;
            $this->apellidoMaterno = $am;
            $this->activo          = $a;
            $this->fechaRegistro   = $f;            
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
                $array["id"]              = $this->getId();
                $array["nombres"]         = $this->getNombres();
                $array["apellidoPaterno"] = $this->getApellidoPaterno();
                $array["apellidoMaterno"] = $this->getApellidoMaterno();
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
            if (empty($array))
            {
                $this->setId($array["id"]);
                $this->setNombres($array["nombres"]);
                $this->setApellidoPaterno($array["apellidoPaterno"]);
                $this->setApellidoMaterno($array["apellidoMaterno"]);
                $this->setActivo($array["activo"]);
                $this->setFechaRegistro($array["fechaRegistro"]);                                               
            }
        }

        /**
         * Calculo para saber que tan diferente es un objeto de otro
         * 
         * @param  Alumno $obj [Objeto con el que se comparara]
         * @return [float]     [Disimilitud entre los dos objetos]
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

            if ($obj->getNombres() != $this->getNombres())
            {
                $numerador += 1;
            }
            
            $denominador += 1;
            
            if ($obj->getApellidoMaterno() != $this->getApellidoMaterno())
            {
                $numerador += 1;
            }

            $denominador += 1;

            if ($obj->getApellidoPaterno() != $this->getApellidoPaterno())
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
        * Gets the value of nombres.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @return mixed
        */
        public function getNombres()
        {
            return $this->nombres;
        }
         
        /**
        * Sets the value of nombres.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @param mixed $nombres the nombres
        *
        * @return self
        */
        public function setNombres($nombres)
        {
            $this->nombres = $nombres;
        }
     
        /**
        * Gets the value of apellidoMaterno.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @return mixed
        */
        public function getApellidoMaterno()
        {
            return $this->apellidoMaterno;
        }
         
        /**
        * Sets the value of apellidoMaterno.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @param mixed $apellidoMaterno the apellido materno
        *
        * @return self
        */
        public function setApellidoMaterno($apellidoMaterno)
        {
            $this->apellidoMaterno = $apellidoMaterno;
        }
     
        /**
        * Gets the value of apellidoPaterno.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @return mixed
        */
        public function getApellidoPaterno()
        {
            return $this->apellidoPaterno;
        }
         
        /**
        * Sets the value of apellidoPaterno.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @param mixed $apellidoPaterno the apellido paterno
        *
        * @return self
        */
        public function setApellidoPaterno($apellidoPaterno)
        {
            $this->apellidoPaterno = $apellidoPaterno;
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