<?php
  namespace Cubo\Framework;
  use Cubo\Framework\Configuration;
  use Cubo\Framework\Database;
  use Cubo\Framework\Error;

  class Model {
    protected $caller;          // Pointer to calling object
    protected $database;        // Database configuration
    protected $params;          // Parameter set

    // Upon construct connect to data source
    public function __construct() {
      $this->connect();
    }

    // Allow returning parameters as JSON
    public function __toString() {
      return (string)$this->params;
    }

    // Pass calling object
    public function calledBy($caller) {
      return $caller? $this->caller = $caller: $this->caller;
    }

    // Connect to data source
    public function connect() {
      // Load database configuration
      $this->params = Configuration::load('database', Configuration::get('config')->get('database'));
      try {
        $sources = $this->params->get('sources', (object)[]);
        if(isset($sources->{$this->getClass()})) {
          $this->database = new Database($sources->{$this->getClass()});
        } else {
          throw new Error('datasource-does-not-exist');
        }
      } catch(Error $error) {
        $error->render();
      }
    }

    // Get class name
    public function getClass() {
      return strtolower(basename(str_replace('\\', '/', get_class($this))));
    }

    // Determine if method exists
    public function methodExists($method) {
      return method_exists($this, $method);
    }

    // Method: get
    public function get() {
      //
    }

    // Method: all
    public function getAll() {
      //
    }

    // Return class name
    public static function className($model = null) {
      return $model? (__CUBO__ == explode('\\', $model)[0]? $model: __CUBO__.'\\Model\\'.ucfirst($model)): __CLASS__;
    }

    // Static method to determine if model exists
    public static function exists($model) {
      return class_exists(self::className($model));
    }
  }
?>
