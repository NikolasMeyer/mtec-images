<?php

namespace MTEC\Images {
    class Loader {
        protected static $_isRegistered = false;

        public static function register() {
            if(!static::$_isRegistered) {
                $loader = new static();
                spl_autoload_register(array(new static(), 'load'));
                static::$_isRegistered = true;
            }
        }

        public function load($className) {
            $fileName = str_replace('\\', '/', $className) . '.php';

            $path = stream_resolve_include_path($fileName);
            if($path !== false) require_once($path);
        }
    }

    \MTEC\Images\Loader::register();
}
