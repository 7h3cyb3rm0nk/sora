<?php 
namespace Sora\Core;

class Router {
  protected $routes = [];

  /** 
   * Route to handle GET requests
   *
   * @param string $path              Path to route for
   * @param array|string $callback   Array with the classname and the method
   *                                  to call or a string containing the function name.
   */
  public function get($path, $callback){
    $this->routes['GET'][$path] = $callback;
  }


  /** 
   * Route to handle POST requests
   *
   * @param string $path            Path to route for.
   * @param array|string $callback  Array with the classname and the method
   *                               to call or a string containing the function name.
   */
  public function post($path, $callback) {
    $this->routes['POST'][$path] = $callback;
  }

  /**
   * Dispatches the request to the appropriate route based on the URI and method.
   */
  public function dispatch(){
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Remove trailing slash if present (except for root "/")
    if(substr($uri, -1) === '/' && strlen($uri) > 1){
      $uri = substr($uri, 0, -1);
    }

    foreach ($this->routes[$method] as $route => $callback) {
      // Check if the route is a regex pattern (excluding just '/')
      if (strpos($route, '/') === 0 && substr($route, -1) === '/' && $route !== '/') { 
        $pattern = $route;

        // Remove leading and trailing slashes from the pattern
        $pattern = substr($pattern, 1, -1);

        // Replace [variable] placeholders with regex capture groups
        $pattern = str_replace('[', '(?P<', $pattern);
        $pattern = str_replace(']', '>[a-zA-Z0-9_-]+)', $pattern); 

        if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
          // Extract named capture groups into an associative array
          $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

          // Call the callback with matched parameters
          if (is_callable($callback)) {
            call_user_func_array($callback, $params);
          } else if (is_array($callback)) {
            $controller = new $callback[0]();
            $method = $callback[1];
            if (method_exists($controller, $method)) {
              call_user_func_array([$controller, $method], $params);
            } else {
              http_response_code(500);
              echo "Error: Method '$method' not found in controller '$callback[0]'.";
            }
          }
          return; // Stop further route matching after a successful match
        }
      } else if ($route === $uri || ($route === '/' && $uri === '')) { 
        // Handle regular routes, including the root path '/'
        if (is_callable($callback)) {
          call_user_func($callback);
        } else if (is_array($callback)) {
          $controller = new $callback[0]();
          $method = $callback[1];
          if (method_exists($controller, $method)) {
            call_user_func_array([$controller, $method], []); 
          } else {
            http_response_code(500);
            echo "Error: Method '$method' not found in controller '$callback[0]'.";
          }
        }
        return; // Stop further route matching after a successful match
      }
    }

    // If no route matched, handle 404
    http_response_code(404);
    echo "404 Not Found";
    echo $_SERVER['REQUEST_URI'];
  }
}
?>