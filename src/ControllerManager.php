<?php


namespace Fragmency\Control;


use Fragmency\Core\Application;

class ControllerManager
{
    private $app;

    public function __construct(Application $app){
        $this->app = $app;
    }

    private function requireController($c){
        $file = $this->app->getControllersFolder()."/".$c."Controller.php";
        if(!file_exists($file)) return false;
        require_once $file;
        return true;
    }

    public function call($do,$view){
        if(!$this->requireController($do)) return false;
        $controller = "Controller\\".$do."Controller";
        if(!class_exists($controller)) return false;
        return new $controller($view);
    }

}