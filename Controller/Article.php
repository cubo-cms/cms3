<?php
  namespace Cubo\Controller;
  use Cubo\Framework\Controller;
  use Cubo\Framework\Error;
  use Cubo\Framework\Model;

  class Article extends Controller {
    // Method: all
    public function all() {
    }

    // Method: category
    public function category() {
    }

    // Method: default
    public function default() {
      return $this->all();
    }

    // Method: read
    public function read() {
      return $this->view();
    }

    // Method: status
    public function status() {
    }

    // Method: view
    public function view() {
      $model = $this->invokeModel();
      return 'Showing '.$this->params->get('controller').': '.$this->params->get('name');
    }
  }
?>
