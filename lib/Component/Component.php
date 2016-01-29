<?php

namespace Component;
use Template;

abstract class Component {
	protected $template;

	public function __construct(Template $template) {
		$this->template = $template;
	}

	public function render() {
		return $this->template->process_output();
	}
}