<?php

namespace Template\Directive;

use Template;

class RenderComponentChildren extends ComponentDirective {

	public function render($template_vars) {
        if (!$this->component) return false;
		return Template::renderComponentChildrenOutput($this->component->getChildren());
	}
}