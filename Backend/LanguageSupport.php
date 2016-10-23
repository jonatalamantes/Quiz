<?php 

    /**
    * A Class for display diferents messages in a current language
    *
    * @author Jonathan Sandoval <[jonathan_s_pisis@yahoo.com.mx]>
    */
    class LanguageSupport
    {
        private static $actualLanguage;
        private static $allMensagges;

        /**
         * Change the current language witch display messages
         * @author Jonathan Sandoval <[jonathan_s_pisis@yahoo.com.mx]>
         * 
         * @param  string $language   'es' or 'en'
         */
        public static function changeLanguage($language = "es")
        {
            if ($language == 'es' || $language == 'en')
            {
                self::$actualLanguage = $language;
            }
            else
            {
                self::$actualLanguage = 'en';
            }
        }

        /**
         * Recover the message from the dictonary
         * @author Jonathan Sandoval <[jonathan_s_pisis@yahoo.com.mx]>
         * 
         * @param  string $message Message in english to display with the actual language
         */
        public static function getLang($message = "")
        {
            if (array_key_exists($message, self::$allMensagges[self::$actualLanguage]))
            {
                return  self::$allMensagges[self::$actualLanguage][$message];
            }
            else
            {
                return $message;
            }
        }

        /**
         * Recover the actual Language used by the class
         * @author Jonathan Sandoval <[jonathan_s_pisis@yahoo.com.mx]>
         * 
         * @return string  Language used by the class ('en' or 'es')
         */
        public static function getActualLanguage()
        {
            return self::$actualLanguage;
        }

        /**
         * Change the ^words^ for her traslation in one HTML Document
         * 
         * @author Jonathan Sandoval <[jonathan_s_pisis@yahoo.com.mx]>
         * @param  string   $page    The page to Traslate
         * @return string            The page traslated
         */
        public static function HTMLEvalLanguage($page = '')
        {
            $myPage   = $page;
            $pageFind = $page;
            $posTag1  = stripos($pageFind, '^');

            while ($posTag1 !== false)
            {
                //Cut until the first tag
                $pageFind = substr($pageFind, $posTag1+1);

                //Cind the next tag °
                $posTag2  = stripos($pageFind, '^');

                //Cut until the second tag
                $toTraslate = substr($pageFind, 0, $posTag2);
                $delimiter  = '^' . $toTraslate . '^';
                
                //Replace with new traslation
                $myPage = str_replace($delimiter, self::getLang($toTraslate), $myPage);

                //update the counter data
                $pageFind = substr($pageFind, $posTag2+1);
                $posTag1  = stripos($pageFind, '^');
            }

            return $myPage;
        }

        /**
         * Inicialize the dictionary
         * @author Jonathan Sandoval <[jonathan_s_pisis@yahoo.com.mx]>
         */
        public static function inicialize()        
        {
            if (!(self::$actualLanguage == 'es' || self::$actualLanguage == 'en'))
            {
                self::$allMensagges = array();

                $leng = "es";
                self::$allMensagges[$leng]["Genesis"] = "GÉNESIS";

                $leng = "en";
                self::$allMensagges[$leng]["Genesis"] = strtoupper("Genesis");

                self::$actualLanguage = "es";
            }
        }
    }

    LanguageSupport::inicialize();
 ?>
