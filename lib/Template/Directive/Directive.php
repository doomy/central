<?php

namespace Template\Directive;


abstract class Directive {
    protected $contents;
    protected $parameters;

    abstract public function render($template_vars);

    public function set_parameters($parameters) {
        $this->parameters = $parameters;
    }

    public function set_contents($contents) {
        $this->contents = $contents;
    }
}

?> 