<?php
  namespace Cubo\Framework;

  final class Database {
    private $connection;
    private $driver;
    private $params;

    // Upon construct connect to database driver
    public function __construct($params = null) {
      $this->connect($params);
    }

    // Connect to database driver
    public function connect($params = null) {
      $this->params = new Set($params);
      try {
        // Determine if a driver exists by invoking its class
        if(Driver::exists($this->params->get('driver', 'mysql'))) {
          echo '<p>Driver found!</p>';
          // Determine if the source exists
          if(Driver::sourceExists($this->params->get('driver', 'mysql'), $this->params->get('source', __CUBO__))) {
            $this->driver = Driver::get($this->params->get('driver', 'mysql'), $this->params->get('source', __CUBO__));
          } else {
            throw new Error(['message'=>'database-does-not-exist', 'params'=>$this->params]);
          }
        } else {
          throw new Error(['message'=>'driver-does-not-exist', 'params'=>$this->params]);
        }
      } catch(Error $error) {
        $error->render();
      }
    }

    // Method: find
    public function find($table, $columns = null, $options = null) {
      return $this->driver->find($table, $columns, $options);
    }

    // Method: findOne
    public function findOne($table, $columns = null, $options = null) {
      return $this->driver->findOne($table, $columns, $options);
    }

    // Method: insert
    public function insert($table, $item) {
      $this->driver->insert($table, $item);
    }
  }
?>
