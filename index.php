<?php
  namespace Cubo\Framework;

  error_reporting(E_ALL);
  ini_set('display_errors',1);

  require('bootstrap.php');

  $app = new Application(__ROOT__.DS.'.config'.DS.'config');

/*
  $app->addRoute('/{{controller}}', ['method'=>'all']);
  $app->addRoute('/{{controller}}/{{name}}', ['method'=>'read']);
  $app->addRoute('/{{controller}}/read/{{name}}', ['method'=>'read']);
  $app->addRoute('/{{controller}}/status/{{status}}', ['method'=>'status']);
  $app->addRoute('/{{controller}}/category/{{category}}', ['method'=>'category']);
  */

  $router = $app->getRouter();
  $app->run();
die;
  //$router->parse($_SERVER['REQUEST_URI']);

  $router->invokeController();
  echo '<pre>'; echo($router); echo '</pre>';
die;

  //echo '<pre>'; print_r($app); echo '</pre>';

  $database = new Database(['driver'=>'json', 'source'=>__ROOT__.DS.'data']);

  $result = $database->find('Accesslevel');

  /*
  $database->insert('Accesslevel', ['_id'=>'4','name'=>'private','title'=>'Private','accesslevel'=>'1','status'=>'1']);
*/
  echo '<pre>'; print_r($result); echo '</pre>';

?>
