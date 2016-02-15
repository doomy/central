<?php
/**
 * Created by PhpStorm.
 * User: doomy
 * Date: 15.2.16
 * Time: 17:47
 */

use Helpers\MockGeoTools;

class GeoToolsFactory {
    public static function getGeoTools() {
        $env = Environment::get_env();
        if($env->CONFIG['DISABLE_REMOTE']) return new MockGeoTools();
        return new GeoTools();

    }
}