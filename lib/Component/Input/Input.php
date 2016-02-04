<?php

namespace Component\Input;

use Component\Component;

abstract class Input extends Component {
	public $label;

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