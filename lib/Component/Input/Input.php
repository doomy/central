<?php

namespace Component\Input;

use Component\Component;

abstract class Input extends Component {
	public $label;
    public $value;

	// TODO: get rid of the setter, all components have magic setters & getters
    public function setLabel($label) {
		$this->label = $label;
	}

    public function receive() {
        if($this->name && isset($_REQUEST[$this->name])) {
            $this->value = $_REQUEST[$this->name];
            return $this->value;
        }
        return false;
    }

    public function render() {
        if (!$this->value)
            $this->receive();
        return parent::render();
    }
}