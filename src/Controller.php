<?php


namespace Fragmency\Control;


use Fragmency\Core\Page;

abstract class Controller
{
    public $page;
    public function __construct($view){
        $this->page = new Page();
        $this->page->setContent('view',$view);
    }
    
    public function __call($name, $arguments)
    {
        [$name,$_] = explode('_',$name);
        if(is_callable([$this,$name])) $return = call_user_func_array([$this,$name],$arguments);
        $return = $return ?? $this->page;
        return is_a($return,'Fragmency\Core\Page') ? $return : $this->page;
    }
}