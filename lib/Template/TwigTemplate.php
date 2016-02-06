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
        $twig = TwigLoader::getTwig();
        echo $twig->render($this->filename, $this->template_vars);
    }
}

?> 