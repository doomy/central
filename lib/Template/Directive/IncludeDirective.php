<?php

namespace Template\Directive;

use Template;


class IncludeDirective extends Directive {
    public function render($template_vars) {
        $filename = $this->parameters[0];

        ob_start();
        $template = new Template($filename);
        $template->show($template_vars);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

?> 