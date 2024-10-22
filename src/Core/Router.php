<?php 
namespace Sora\Core;

class Router {
  protected $routes = [];

/** route to get requests
 *
 * @param string $path              path to route for
 * @param array| string $callback   array with the classname and the method
 *                                  to call or a string containing the function name.
 */
  public function get($path, $callback){
    $this->routes['GET'][$path] = $callback;

  }


  /** route to get requests
   *
   * @param string $path            path to route for.
   * @param array|string $callback  array with the classname and the method
   *                               to call or a string containing the function name.
   *
   */

  public function post($path, $callback) {
    $this->routes['POST'][$path] = $callback;

  }

  /**
   * function to dispatch to the routes from the uri
   *
   *
   */

  public function dispatch(){
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if(substr($uri, -1) === '/' && strlen($uri) > 1){
      $uri = substr($uri, 0, -1);
    }

    if(isset($this->routes[$method][$uri])){
      $callback = $this->routes[$method][$uri];

      if(is_callable($callback)){
        call_user_func($callback);

      }else if(is_array($callback)){
        $controller = new $callback[0]();
        $method = $callback[1];
        if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], []);
            } else {
                http_response_code(500);
                echo "Error: Method '$method' not found in controller '$callback[0]'.";
            }
      }
    }
    else{
      http_response_code(404);
      echo "404 Not Found";
      echo $_SERVER['REQUEST_URI'];
    }


  }

}
