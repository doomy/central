<?php

namespace Template\Directive;


class ForeachDirective extends Directive {
    public function render($template_vars) {
        $output = "";
        $variable_name = ltrim($this->parameters[0], '$');
        foreach ($template_vars[$variable_name] as $elt) {
            $output .= $this->contents;
        }
        return $output;
    }

}

?> 