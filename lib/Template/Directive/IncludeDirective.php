<?php

namespace Template\Directive;

use Template;
use Template\TwigTemplate;


class IncludeDirective extends Directive {
    public function render($template_vars) {
        $filename = $this->parameters[0];
        $parts = explode('.', $filename);
        $ext = array_pop($parts);
        if ($ext == 'twig') $template = new TwigTemplate($filename, $template_vars);
        else $template = new Template($filename, $template_vars);

        ob_start();
        $template->show();
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

?> 