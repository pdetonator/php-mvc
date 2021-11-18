<?php 

    class Route
    {

        public $request_uri;
        public $routes = array();
        public $patterns = array(
            ':id' => '([0-9]+)'
        );
        private $error = false;
        private $uri;
        
        public function __construct()
        {
            $this -> request_uri = str_replace(array(
                dirname($_SERVER['SCRIPT_NAME']),
                basename($_SERVER['SCRIPT_NAME'])
            ), '', $_SERVER['REQUEST_URI']);
        }

        public function add($uri, $callback)
        {
            if (!in_array($this -> routes, [$uri])) {

                $this -> routes[$uri] = [
                    'callback' => $callback,
                    'method' => ['GET']
                ];

                $this -> uri = $uri;
            }

            return $this;
        }

        public function post()
        {
            $this -> routes[$this -> uri]['method'] = ['POST'];
        }

        public function get()
        {
            $this -> routes[$this -> uri]['method'] = ['GET'];
        }

        public function any()
        {
            $this -> routes[$this -> uri]['method'] = ['GET', 'POST'];
        }

        public function run() 
        {
            if (!is_null($this -> routes)) {

                foreach ($this -> routes as $index => $route) {
                    
                    $index = str_replace(array_keys($this -> patterns), array_values($this -> patterns), $index);

                    if (preg_match('@^' . $index . '$@', $this -> request_uri, $params)) {

                        if (in_array($_SERVER['REQUEST_METHOD'], $route['method'])) {
                            
                            array_shift($params);

                            if (is_callable($route['callback'])) {
                                
                                call_user_func_array($route['callback'], $params);

                            }else {
                                
                                $controller = explode('/', $route['callback']);

                                if (count($controller) === 1) {
                                    
                                    if ($this -> controller_exist($controller[0])) {

                                        require $this -> controller_exist($controller[0])['file_name'];

                                        call_user_func_array([new $controller[0], 'index'], $params);

                                    }

                                }else {

                                    require $this -> controller_exist($controller[0])['file_name'];

                                    call_user_func_array([new $controller[0], $controller[1]], $params);

                                }

                            }
                        }
                        
                    }
                    
                }

            }
        }
        
        public function controller_exist($name)
        {

            $controller_file = dirname(__DIR__) . '/controllers/' . strtolower($name) . '.php';

            if (file_exists($controller_file)) return array(
                'isExist' => 1,
                'file_name' => $controller_file
            );
            return array(
                'isExist' => 0
            );
            
        }

    }

?>