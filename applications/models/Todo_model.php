<?php

    class Todo_model extends Model
    {

        public function __construct()
        {
            parent::__construct();
        }

        public function getAll()
        {

            return $this -> db -> from('todos') -> all();

        }

    }

?>