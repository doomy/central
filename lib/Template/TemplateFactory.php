<?php

namespace Template;

use \Template;
use Template\TwigTemplate;


class TemplateFactory {
    public static function getTemplate($filename, $template_vars) {
        $parts = explode('.', $filename);
        $ext = array_pop($parts);
        if ($ext == 'twig') return new TwigTemplate($filename, $template_vars);
        else return new Template($filename, $template_vars);
    }
}

?> 