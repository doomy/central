<?php

namespace Template\Directive;

use Template;


class ForeachDirective extends Directive {
    public function render($template_vars) {
        $output = "";
        $list_variable = ltrim($this->parameters[0], '$');
        $content_variable_name = ltrim($this->parameters[1], '$');

        foreach ($template_vars[$list_variable] as $elt) {
            $content_template_vars = array($content_variable_name => $elt);
            $template = new Template(null, $content_template_vars);
            $content_output = $template->process_output($this->contents);
            $output .= $content_output;
            unset($template);
        }
        return $output;
    }

}

?> 