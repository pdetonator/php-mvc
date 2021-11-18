<?php

    class Controller
    {

        public function view($view, $data = array())
        {

            $view_file = dirname(__DIR__) . '/views/' . strtolower($view) . '.php';

            if (file_exists($view_file)) {

                extract($data);
                require $view_file;

            }

        }

        public function model($model)
        {

            $model_file = dirname(__DIR__) . '/models/' . strtolower($model) . '.php';

            if (file_exists($model_file)) {

                require $model_file;

                return new $model();

            }else {
                echo 'yok1';
            }

        }

        public function helper($helper)
        {

            $helper_file = dirname(__DIR__) . '/helpers/' . strtolower($helper) . '_helper.php';

            if (file_exists($helper_file)) {

                require $helper_file;

            }

        }

    }

?>