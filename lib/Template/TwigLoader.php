<?php

namespace Template;

use Environment;

class TwigLoader {
    private static $twig;

    public static function getTwig() {
        if (!self::$twig) {
            $env = Environment::get_env();
            \Twig_Autoloader::register();

            $localTemplatePath = $env->CONFIG['LOCAL_PATH'] . 'templates';
            $localLoader = new \Twig_Loader_Filesystem($localTemplatePath);

            $centralTemplatePath = $env->CONFIG['CENTRAL_PATH'] . 'templates';
            $centralLoader = new \Twig_Loader_Filesystem($centralTemplatePath);

            $loader = new \Twig_Loader_Chain(array($localLoader, $centralLoader));

            self::$twig = new \Twig_Environment($loader, array('cache' => false)); // TODO: use $cachePath. Currently it won't register template change for some reason
        }
        return self::$twig;
    }

}

?> 