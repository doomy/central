<?php

namespace Template;

use Environment;

class TwigLoader {
    private static $twig;

    public static function getTwig() {
        if (!self::$twig) {
            $env = Environment::get_env();
            \Twig_Autoloader::register();
            $templatePath = $env->CONFIG['CENTRAL_PATH'] . 'templates';
            $cachePath    = $env->CONFIG['CENTRAL_PATH'] . 'cache/twig';
            $loader = new \Twig_Loader_Filesystem($templatePath);
            self::$twig = new \Twig_Environment($loader, array('cache' => false)); // TODO: use $cachePath. Currently it won't register template change for some reason
        }
        return self::$twig;
    }

}

?> 