<?php 
    
    if(session_id() == '' || !isset($_SESSION)) 
    { 
        session_start(); 
    }

    require_once("LanguageSupport.php");

    /**
    * Class for manipulate User Objects
    * 
    * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
    */
    class SessionManager
    {
        /**
         * Get the last page $_SESSION
         * 
         * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
         * @return string   The past page
         */
        static function getLastPage()
        {
            return $_SESSION["last_page"];
        }

        /**
         * Get the current page $_SESSION
         * 
         * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
         * @return string   The current page
         */
        static function getCurrentPage()
        {
            return $_SESSION["curr_page"];
        }

        /**
         * Get the last query $_SESSION
         * 
         * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
         * @return string   The last query
         */
        static function getLastQuery()
        {
          return $_SESSION["last_query"];
        }

        /**
         * Change the last query on the database
         * 
         * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
         * @return string   $newQuery   The new query
         */
        static function setLastQuery($newQuery = "")
        {
          $_SESSION["last_query"] = $newQuery;
        }

        /**
         * Validate the user in the actual page, if not user, move to index page
         * 
         * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
         * @param  string    $page   The actual page
         */
        static function validateUserInPage($page = "", $idChurch = 0, $idChurch2 = -1)
        {
            if ($page === "bitacoraInsertion.php")
            {
                if ($_SERVER["REMOTE_ADDR"] == "10.15.50.174" || $_SERVER["REMOTE_ADDR"] == "10.15.50.80" || $_SERVER["REMOTE_ADDR"] == "10.15.50.107" )
                {
                    #Puede continuar navegando en la pagina
                }
                else if (array_key_exists("CATEGORIA_USR", $_SESSION))
                {
                    if (strpos($_SESSION["CATEGORIA_USR"], "ADMIN") !== FALSE)
                    {
                        #Puede continuar navegando en la pagina
                    }
                    else
                    {
                        echo "<script src='JS/functions.js'></script><script>alert('No tiene permisos para abrir la bitacora');href('../index.php')</script>";  
                    }
                }
                else
                {
                    echo "<script src='JS/functions.js'></script><script>alert('No tiene permisos para abrir la bitacora');href('../index.php')</script>";
                }
                
                //echo "<script src='JS/functions.js'></script><script>href('../index.php')</script>";
            }

            if (array_key_exists("ID_USUARIO", $_SESSION) === FALSE)
            {
                echo "<script src='JS/functions.js'></script><script>href('../index.php')</script>";
            }

            if ($_SESSION["curr_page"] != $_SERVER['REQUEST_URI'])
            {
                $_SESSION["last_page"] = SessionManager::getCurrentPage();
                $_SESSION["curr_page"] = $_SERVER['REQUEST_URI'];
            }

            //var_dump($_SESSION["last_page"]); var_dump($_SESSION["curr_page"]);
        }
    }

 ?>