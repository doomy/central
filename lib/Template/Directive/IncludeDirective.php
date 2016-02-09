<?php

namespace Template\Directive;

use Template;
use Template\TemplateFactory;


class IncludeDirective extends Directive {
	private $component;

	public function __construct($component = null) {
		if($component) $this->component = $component;
	}

    public function render($template_vars) {
        $filename = $this->parameters[0];
        $template = TemplateFactory::getTemplate($filename, $template_vars);
		if($this->component) $template->attach_component($this->component);
        ob_start();
        $template->show();
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

?> 