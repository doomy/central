<?php

class Template extends Base\Package {
// version 3

    public function __construct($filename) {
        $this->filename = $filename;
        parent::__construct();
    }

    public function show($template_vars = array()) {
        foreach($template_vars as $template_var_name => $template_var_value)
        ${$template_var_name} = $template_var_value;
        
        include($this->env->basedir . 'templates/' . $this->filename);
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
