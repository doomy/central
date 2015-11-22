<?php

class Template {
    public function __construct($filename) {
        $this->filename = $filename;
    }

    public function show($template_vars = array()) {
        $env = Environment::get_env();
        foreach($template_vars as $template_var_name => $template_var_value)
        ${$template_var_name} = $template_var_value;
        ob_start();
        include($env->basedir . 'templates/' . $this->filename);
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }
}
?>
