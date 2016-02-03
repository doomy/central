<?php

namespace Component\Input;

use Component\Component;

abstract class Input extends Component {
	public $name;
	public $label;

	public function setName($name) {
		$this->name = $name;
	}

	public function setLabel($label) {
		$this->label = $label;
	}

    public function receive() {
        if(isset($_REQUEST[$this->name])) {
            return $_REQUEST[$this->name];
        }
        return false;
    }

} 