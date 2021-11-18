<?php

    class Model extends Database
    {

        protected $db;

        public function __construct()
        {
            return $this -> db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD, DB_CHARSET);
        }

    }

?>