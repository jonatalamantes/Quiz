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
         * Change the last query on the database
         * 
         * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
         * @return string   $newQuery   The new query
         */
        static function getTipoAlumno()
        {
            if (array_key_exists("tipoAlumno", $_SESSION) !== FALSE)
            {
                return $_SESSION["tipoAlumno"];    
            }

            return NULL;
        }

        /**
         * Change the last query on the database
         * 
         * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
         * @return string   $newQuery   The new query
         */
        static function getIdAlumno()
        {
            if (array_key_exists("idAlumno", $_SESSION) !== FALSE)
            {
                return $_SESSION["idAlumno"];    
            }

            return NULL;
        }

        /**
         * Validate the user in the actual page, if not user, move to index page
         * 
         * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
         * @param  string    $page   The actual page
         */
        static function validateUserInPage($page = "")
        {
            if (array_key_exists("idAlumno", $_SESSION) === FALSE)
            {
                echo "<script src='JS/functions.js'></script><script>window.location.href = 'index.php'</script>";
            }

            if ($page == "menu_admin.php")
            {
                if (array_key_exists("tipoAlumno", $_SESSION) === FALSE)
                {
                    echo "<script src='JS/functions.js'></script><script>window.location.href = 'index.php'</script>";
                }
                else
                {
                    $tipo = $_SESSION["tipoAlumno"];

                    if ($tipo !== "Admin")
                    {
                        echo "<script src='JS/functions.js'></script><script>window.location.href = 'index.php'</script>";
                    }
                }
            }


            if ($page == "menu_alumno.php")
            {
                if (array_key_exists("tipoAlumno", $_SESSION) === FALSE)
                {
                    echo "<script src='JS/functions.js'></script><script>window.location.href = 'index.php'</script>";
                }
                else
                {
                    $tipo = $_SESSION["tipoAlumno"];

                    if ($tipo !== "Normal")
                    {
                        echo "<script src='JS/functions.js'></script><script>window.location.href = 'index.php'</script>";
                    }
                }
            }

            if ($_SESSION["curr_page"] != $_SERVER['REQUEST_URI'])
            {
                $_SESSION["last_page"] = SessionManager::getCurrentPage();
                $_SESSION["curr_page"] = $_SERVER['REQUEST_URI'];
            }
        }

        /**
         * Get the navbar using in the pages in relation with the type of user
         * 
         * @author Jonathan Sandoval <jonathan_s_pisis@yahoo.com.mx>
         * @return string    The HTML navbar to use
         */
        static function getNavBar()
        {
            if (array_key_exists("tipoAlumno", $_SESSION) === FALSE)
            {
                echo "<script src='JS/functions.js'></script><script>window.location.href = 'index.php'</script>";
            }
            else
            {
                if ($_SESSION["tipoAlumno"] !== 'Normal')
                {
                    $nav = '<nav class="navbar navbar-inverse navbar-fixed-top">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="main.php" id="headerLanguage">Quiz</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="menu_admin.php">Home</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Ir al Menú<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="alumno_menu.php">Alumno</a></li>
                                            <li><a href="curso_menu.php">Curso</a></li>
                                            <li><a href="cuestionario_menu.php">Cuestionario</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Insertar Nuevo<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="alumno_insertar.php">Alumno</a></li>
                                            <li><a href="curso_insertar.php">Curso</a></li>
                                            <li><a href="cuestionario_insertar.php">Cuestionario</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#" onclick="window.location.href=\'index.php\';">Salir</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>';
                }
                else //is Normal
                {
                    $nav = '<nav class="navbar navbar-inverse navbar-fixed-top">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="main.php" id="headerLanguage">Quiz</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="menu_normal.php">Home</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Ir al Menú<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="alumno_menu.php">Alumno</a></li>
                                            <li><a href="curso_menu.php">Curso</a></li>
                                            <li><a href="cuestionario_menu.php">Cuestionario</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Insertar Nuevo<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="alumno_insertar.php">Alumno</a></li>
                                            <li><a href="curso_insertar.php">Curso</a></li>
                                            <li><a href="cuestionario_insertar.php">Cuestionario</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#" onclick="window.location.href=\'index.php\';">Salir</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>';
                }

                return $nav;
            }
        }
    }

 ?>