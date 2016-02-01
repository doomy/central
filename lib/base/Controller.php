<?php

namespace base;

use Component\Presenter;
use Component\ComponentFactory;

abstract class Controller {
    protected $action;
	protected $presenter;

    public function __construct() {
        if (isset($_REQUEST['action'])) {
            $this->set_action($_REQUEST['action']);
        }
		$this->presenter = ComponentFactory::getComponent(Presenter::class);
    }
    
    public function set_action($action) {
        $this->action = $action; 
    }

    abstract function run();

}

?>