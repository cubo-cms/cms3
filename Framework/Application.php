<?php
  namespace Cubo\Framework;

  final class Application {
    private $configuration;     // Configuration set
    private $route;             // Pointer to router object
    private $routes;            // Set of routes

    // Upon construct initialise the application
    public function __construct($config = null) {
      $this->init($config);
    }

    // Allow returning configuration as JSON
    public function __toString() {
      return (string)$this->configuration;
    }

    // Add a new route
    public function addRoute($path, $params = null) {
      is_null($this->routes) && $this->routes = [];
      $this->routes[] = new Route($path, $params);
    }

    // Get configuration parameter
    public function get($property, $default = null) {
      is_null($this->configuration) && $this->configuration = new Set();
      return $this->configuration->get($property, $default);
    }

    // Return router object
    public function getRouter() {
      return $this->router ?? $this->router = new Router($this->routes ?? []);
    }

    // Retrieve set of routes
    public function getRoutes() {
      return $this->routes ?? [];
    }

    // Initialise the application
    public function init($config = null) {
      // Load configuration
      $this->configuration = new Set($config);
      // Load routes from configuration
      $this->loadRoutes($this->configuration->get('routes', []));
    }

    // Load routes from configuration
    private function loadRoutes($routes) {
      is_array($routes) && $routes = (object)$routes;
      // Iterate through routes
      foreach($routes as $path=>$params) {
        $this->addRoute($path, $params);
      }
    }

    // Start the application
    public function run() {
      // Get router object
      $router = $this->getRouter();
      // Invoke controller
      $router->invokeController();
      // Invoke method
      echo $router->invokeMethod();
    }

    // Set configuration parameter
    public function set($property, $value) {
      is_null($this->configuration) && $this->configuration = new Set();
      $this->configuration->set($property, $value);
    }
  }
?>
