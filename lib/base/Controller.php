<?php

namespace base;

use Component\Presenter;
use Component\ComponentFactory;

abstract class Controller {
    protected $action;
	protected $presenter;
    protected $defaultAction = "index";

    public function __construct() {
        if (isset($_REQUEST['action']))
            $this->set_action($_REQUEST['action']);
        elseif($this->defaultAction)
            $this->set_action($this->defaultAction);
		$this->presenter = $this->initPresenter();
    }
    
    public function set_action($action) {
        $this->action = $action; 
    }

    public function run() {
        if (isset($this->action)) {
            $methodName = "action".ucfirst($this->defaultAction);
            $this->$methodName();
        }
        echo $this->presenter->render();
    }

    protected function initPresenter() {
        return ComponentFactory::getComponent(Presenter::class);
    }
}

?>