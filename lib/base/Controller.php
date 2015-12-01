<?php

namespace base;

abstract class Controller {
    protected $action;

    public function __construct() {
        if (isset($_REQUEST['action'])) {
            $this->set_action($_REQUEST['action']);
        }
    }
    
    public function set_action($action) {
        $this->action = $action; 
    }

    abstract function run();

}

?>