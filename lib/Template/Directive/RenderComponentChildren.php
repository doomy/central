<?php

namespace Template\Directive;

class RenderComponentChildren extends Directive {
	private $component;

	public function __construct($component) {
		$this->component = $component;
	}

	public function render($template_vars) {
		$output = '';
		foreach($this->component->getChildren() as $child_component) {
			$output .= $child_component->render();
		}
		return $output;
	}
}