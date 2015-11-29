<?php

use Template\Directive\DirectiveFactory;
use Template\Directive\DirectiveParser;

class Template {
    private $template_vars;

    public function __construct($filename = null, $template_vars = null) {
        $this->filename = $filename;
        $this->template_vars = $template_vars;
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

    public function process_output($output) {
        $output = $this->process_nested_directives($output);
        $output = $this->process_simple_directives($output);
        return $output;
    }

    private function process_nested_directives($output) {
        $startpos = strpos($output, DirectiveParser::DIRECTIVE_START);

        while($startpos > -1) {
            $endpos = strpos($output, DirectiveParser::DIRECTIVE_END, $startpos);
            $length = $endpos - $startpos + 3;
            $raw_directive = substr($output, $startpos, $length);
            $directive_name = DirectiveParser::get_directive_name($raw_directive);
            if (DirectiveFactory::is_nested_directive($directive_name)) {
                $end_tag = DirectiveParser::DIRECTIVE_START . '/' . $directive_name .  DirectiveParser::DIRECTIVE_END;
                $endpos = strpos($output, $end_tag);
                $length = $endpos - $startpos + strlen($end_tag);
                $raw_directive = substr($output, $startpos, $length);
                $replace = $this->process_directive($raw_directive, $output);
                $output = substr_replace($output,$replace,$startpos,$length);
            }
            $startpos = strpos($output, DirectiveParser::DIRECTIVE_START, $endpos); // next occurence
        }
        return $output;
    }

    private function process_simple_directives($output) {
        $startpos = strpos($output, DirectiveParser::DIRECTIVE_START);
        while($startpos > -1) {
            $endpos = strpos($output, DirectiveParser::DIRECTIVE_END);
            $length = $endpos - $startpos + 3;
            $raw_directive = substr($output, $startpos, $length);
            $replace = $this->process_directive($raw_directive, $output);
            $output = substr_replace($output,$replace,$startpos,$length);
            $startpos = strpos($output, DirectiveParser::DIRECTIVE_START); // next occurence
        }
        return $output;
    }

    private function process_directive($directive_code, $output) {
        $directive = DirectiveFactory::get_directive($directive_code);
        return $directive->render($this->template_vars);
    }
}
?>
