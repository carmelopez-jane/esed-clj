<?php

namespace Framework;

use App\Controllers\ErrorController;

class Router {
  protected $routes = [];

  /**
   * Add a new route
   *
   * @param string $method
   * @param string $uri
   * @param string $action
   * @return void
   */
  public function registerRoute($method, $uri, $action) {
    list($controller, $controllerMethod) = explode( '@', $action);

    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller,
      'controllerMethod' => $controllerMethod
    ];
  }

  /**
   * Add GET route
   *
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function get($uri, $controller) {
    $this->registerRoute('GET', $uri, $controller);
  }

  /**
   * Route the request
   *
   * @param string uri
   * @param string method
   * @return void
   */
  public function route($uri) {
    $method = $_SERVER['REQUEST_METHOD'];

    foreach($this->routes as $route) {

      if($route['uri'] == $uri && $route['method'] === $method) {
        $controller = 'App\\Controllers\\'.$route['controller'];
        $controllerMethod = $route['controllerMethod'];

        //instantiate the controller and call method
        $controllerInstance = new $controller();
        $controllerInstance->$controllerMethod();
        return;
      }
    }
  }
}