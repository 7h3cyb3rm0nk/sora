<?php
namespace Sora\Core;

class Router {
    protected $routes = [];

    /**
     * Route GET requests
     *
     * @param string $path Path to route for
     * @param array|string $callback Array with the classname and method
     * to call or a string containing the function name
     */
    public function get($path, $callback) {
        $path = $this->prepareRoute($path);
        $this->routes['GET'][$path] = $callback;
    }

    /**
     * Route POST requests
     *
     * @param string $path Path to route for
     * @param array|string $callback Array with the classname and method
     * to call or a string containing the function name
     */
    public function post($path, $callback) {
        $path = $this->prepareRoute($path);
        $this->routes['POST'][$path] = $callback;
    }

    /**
     * Prepare route pattern by converting :any and :num to regex
     *
     * @param string $path Original route path
     * @return string Prepared route pattern
     */
    protected function prepareRoute($path) {
        $path = str_replace(
            array(':any', ':num'),
            array('([^/]+)', '([0-9]+)'),
            $path
        );
        return '#^' . $path . '/?$#';
    }

    /**
     * Match URI against route pattern
     *
     * @param string $pattern Route pattern
     * @param string $uri Request URI
     * @return bool|array False if no match, array of matches if found
     */
    protected function matchRoute($pattern, $uri) {
        $matches = array();
        if (preg_match($pattern, $uri, $matches)) {
            array_shift($matches); 
            return $matches;
        }
        return false;
    }

    /**
     * Dispatch to the routes from the URI
     */
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if (substr($uri, -1) === '/' && strlen($uri) > 1) {
            $uri = substr($uri, 0, -1);
        }

        // Check each route pattern for the current method
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $pattern => $callback) {
                $matches = $this->matchRoute($pattern, $uri);
                         
                if ($matches !== false) {
                    if (is_callable($callback)) {
                        call_user_func_array($callback, $matches);
                        return;
                    } else if (is_array($callback)) {
                        $controller = new $callback[0]();
                        $method = $callback[1];
                        
                        if (method_exists($controller, $method)) {
                            call_user_func_array([$controller, $method], $matches);
                            return;
                        } else {
                            http_response_code(500);
                            echo "Error: Method '$method' not found in controller '$callback[0]'.";
                            return;
                        }
                    }
                }
            }
        }

        // No matching route found
        http_response_code(404);
        echo "404 Not Found\n";
        echo $_SERVER['REQUEST_URI'];
    }
}