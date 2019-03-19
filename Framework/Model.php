<?php
  namespace Cubo\Framework;

  class Model {
    protected $params;

    // Allow returning parameters as JSON
    public function __toString() {
      return (string)$this->params;
    }

    // Determine if method exists
    public function methodExists($method) {
      return method_exists($this, $method);
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
