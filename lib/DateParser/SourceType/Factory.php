<?php

namespace DateParser\SourceType;

class Factory {
    private function get_sourcetype_classes() {
        return array('Unknown');
    }

    public static function get_sourcetype_object($source_date) {
        foreach (self::get_sourcetype_classes() as $class) {
            $source_type = eval("
                use DateParser\\SourceType\\$class;
                return new $class();
            ");
            if ($source_type->check($source_date)) {
               return $source_type;
            }
        }
        return new Unknown();
    }
}

?> 