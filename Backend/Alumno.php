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

        /**
         * Constructor de la Clase
         * 
         * @param integer $i  [id]
         * @param string  $n  [nombres]
         * @param string  $ap [apellidoPaterno]
         * @param string  $am [apellidoMaterno]
         */
        function __construct($i = 0, $n = "", $ap = "", $am = "")
        {
            $this->id              = $i;
            $this->nombres         = $n;
            $this->apellidoPaterno = $ap;
            $this->apellidoMaterno = $am;
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
            }
        }

        /**
         * Calculo para saber que tan diferente es un objeto de otro
         * 
         * @param  Alumno $obj [Objeto con el que se comparara]
         * @return [float]     [Disimilitud entre los dos objetos]
         */
        public function disimilitud($obj = new Alumno())
        {
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
         * Gets the value of nombres.
         *
         * @return mixed
         */
        public function getNombres()
        {
            return $this->nombres;
        }

        /**
         * Sets the value of nombres.
         *
         * @param mixed $nombres the nombres
         *
         * @return self
         */
        public function setNombres($nombres)
        {
            $this->nombres = $nombres;

            return $this;
        }

        /**
         * Gets the value of apellidoMaterno.
         *
         * @return mixed
         */
        public function getApellidoMaterno()
        {
            return $this->apellidoMaterno;
        }

        /**
         * Sets the value of apellidoMaterno.
         *
         * @param mixed $apellidoMaterno the apellido materno
         *
         * @return self
         */
        public function setApellidoMaterno($apellidoMaterno)
        {
            $this->apellidoMaterno = $apellidoMaterno;

            return $this;
        }

        /**
         * Gets the value of apellidoPaterno.
         *
         * @return mixed
         */
        public function getApellidoPaterno()
        {
            return $this->apellidoPaterno;
        }

        /**
         * Sets the value of apellidoPaterno.
         *
         * @param mixed $apellidoPaterno the apellido paterno
         *
         * @return self
         */
        public function setApellidoPaterno($apellidoPaterno)
        {
            $this->apellidoPaterno = $apellidoPaterno;

            return $this;
        }

        /**
         * Gets the value of idCurso.
         *
         * @return mixed
         */
        public function getIdCurso()
        {
            return $this->idCurso;
        }

        /**
         * Sets the value of idCurso.
         *
         * @param mixed $idCurso the id curso
         *
         * @return self
         */
        public function setIdCurso($idCurso)
        {
            $this->idCurso = $idCurso;

            return $this;
        }
    }


 ?>