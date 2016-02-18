<?php

namespace Template;

use Template\TwigLoader;

class TwigTemplate extends \Template {
    protected $filename;

    public function __construct($filename, $template_vars) {
        $this->filename = $filename;
        parent::__construct($filename, $template_vars);
    }

    public function process_output() {
        if ($this->component) $this->update_component_variables();
        if ($this->component && $this->component->hasChildren())
            $this->setComponentChildrenOutput();
        $twig = TwigLoader::getTwig();
        return $twig->render($this->filename, $this->template_vars);
    }

    private function setComponentChildrenOutput() {
        $output = parent::renderComponentChildrenOutput($this->component->getChildren());
        $this->template_vars['component_children_output'] = $output;
    }
}

?> 