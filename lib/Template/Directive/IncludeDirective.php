<?php

namespace Template\Directive;

use Template;
use Template\TemplateFactory;


class IncludeDirective extends Directive {
    public function render($template_vars) {
        $filename = $this->parameters[0];
        $template = TemplateFactory::getTemplate($filename, $template_vars);
        ob_start();
        $template->show();
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

?> 