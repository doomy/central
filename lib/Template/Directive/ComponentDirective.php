<?php

namespace Template\Directive;


abstract class ComponentDirective extends Directive {
    protected $component;

    public function __construct($component) {
        $this->component = $component;
    }
}

?> 