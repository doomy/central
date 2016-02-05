<?php

namespace Template\Directive;

use Template;

class RenderComponentChildren extends Directive {
	private $component;

	public function __construct($component) {
		$this->component = $component;
	}

	public function render($template_vars) {
        if (!$this->component) return false;
		return Template::renderComponentChildrenOutput($this->component->getChildren());
	}
}