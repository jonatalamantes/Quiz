<?php 

	/**
	* 	Clase para un Pregunta
	*/
	class RelacionOpcionPregunta
	{
		private $id;
        private $idOpcion;
        private $idPregunta;
		private $liberada;

		function __construct($i = 0, $o = "", $p = "", $l = false)
		{
			$this->id         = $i;
            $this->idOpcion   = $o;
            $this->idPregunta = $p;
			$this->liberada   = $l;
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
        * Gets the value of idOpcion.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @return mixed
        */
        public function getIdOpcion()
        {
            return $this->idOpcion;
        }
         
        /**
        * Sets the value of idOpcion.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @param mixed $idOpcion the id opcion
        *
        * @return self
        */
        public function setIdOpcion($idOpcion)
        {
            $this->idOpcion = $idOpcion;
        }
     
        /**
        * Gets the value of idPregunta.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @return mixed
        */
        public function getIdPregunta()
        {
            return $this->idPregunta;
        }
         
        /**
        * Sets the value of idPregunta.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @param mixed $idPregunta the id pregunta
        *
        * @return self
        */
        public function setIdPregunta($idPregunta)
        {
            $this->idPregunta = $idPregunta;
        }
     
        /**
        * Gets the value of liberada.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @return mixed
        */
        public function getLiberada()
        {
            return $this->liberada;
        }
         
        /**
        * Sets the value of liberada.
        *
        * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
        * @param mixed $liberada the liberada
        *
        * @return self
        */
        public function setLiberada($liberada)
        {
            $this->liberada = $liberada;
        }
    }


 ?>