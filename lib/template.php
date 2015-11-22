<?php

class Template {
    private $template_vars;

    public function __construct($filename) {
        $this->filename = $filename;
    }

    public function show($template_vars = array()) {
        $env = Environment::get_env();
        $this->template_vars = $template_vars;
        foreach($template_vars as $template_var_name => $template_var_value)
        ${$template_var_name} = $template_var_value;
        ob_start();
            include($env->basedir . 'templates/' . $this->filename);
            $output = ob_get_contents();
        ob_end_clean();
        $output = $this->process_output($output);

        echo $output;
    }

    private function process_output($output) {
        $startpos = strpos($output, '<<<');
        while($startpos > -1) {
            $endpos = strpos($output, '>>>');
            $length = $endpos - $startpos + 3;
            $raw_directive = substr($output, $startpos, $length);
            $replace = $this->process_directive($raw_directive);
            $output = substr_replace($output,$replace,$startpos,$length);
            $startpos = strpos($output, '<<<'); // next occurence
        }
        return $output;
    }

    private function process_directive($directive) {
        $directive = trim($directive, '<');
        $directive = trim($directive, '>');
        $parts = explode("=", $directive);
        if ($parts[0] == 'include') {
            ob_start();
                $template = new Template($parts[1]);
                $template->show($this->template_vars);
                $output = ob_get_contents();
            ob_end_clean();
        }
        return $output;
    }
}
?>
