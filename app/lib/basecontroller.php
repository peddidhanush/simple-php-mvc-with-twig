<?php
    abstract class BaseController {
       
        public function model($model)
        {
            /**
             * Load model
             */
            require_once "../app/models/{$model}.php";
            return new $model;
        }
        public function view($file, $array)
        {
            # code...
            /**
             * Load View's using Twig Template
             */
            require '../app/vendor/autoload.php';
            define('DS', DIRECTORY_SEPARATOR);
            $views = '../app/views';
            if(file_exists("{$views}/{$file}")) {
                $loader = new Twig_Loader_Filesystem($views);
                $twig = new Twig_Environment($loader);
                echo $twig->render($file, $array);
            } else {
                die('View File Does not Exist');
            }
        }
    }