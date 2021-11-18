<?php

    class Todo extends Controller
    {

        public function showAll()
        {
            $todo = $this -> model('Todo_model');
            $this -> view('Todo', array(
                'todos' => $todo -> getAll()
            ));

        }

    }

?>