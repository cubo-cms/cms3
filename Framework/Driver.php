<?php
  namespace Cubo\Framework;

  class Driver {
    protected static $driver;
    protected $params;

    // Static method to determine if driver exists
    public static function exists($driver) {
      $driverClass = __CUBO__.'\\Driver\\'.ucfirst($driver);
      return class_exists($driverClass);
    }

    // Return driver object
    public static function get($driver, $source) {
      $driverClass = __CUBO__.'\\Driver\\'.ucfirst($driver);
      return self::$driver ?? self::$driver = new $driverClass($driver, $source);
    }

    // Static method to determine if driver's schema exists
    public static function sourceExists($driver, $source) {
      if(self::exists($driver)) {
        $driverClass = __CUBO__.'\\Driver\\'.ucfirst($driver);
        self::$driver ?? self::$driver = new $driverClass($driver, $source);
        return self::$driver::sourceExists($driver, $source);
      }
      return false;
    }
  }
?>
