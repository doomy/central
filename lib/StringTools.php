<?php

class StringTools {
    static public function remove_nonnumeric_characters($string) {
        return preg_replace('/\D/', '', $string);
    }

}

?> 