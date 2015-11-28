<?php

namespace Template\Directive;

use Template;


class IncludeDirective extends Directive {
    private $filename;

    public function __construct($filename) {
        $this->filename = $filename;
    }

    public function render($template_vars) {
        ob_start();
        $template = new Template($this->filename);
        $template->show($template_vars);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

?> 