<?php

class Template {
// version 3

    public function __construct($filename) {
        $this->filename = $filename;
    }

    public function show($template_vars = array()) {
        $env = Environment::get_env();
        foreach($template_vars as $template_var_name => $template_var_value)
        ${$template_var_name} = $template_var_value;
        
        include($env->basedir . 'templates/' . $this->filename);
    }

    public function get_html_output($template_vars = array()) {
        ob_start();
        $this->show($template_vars);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}
?>
