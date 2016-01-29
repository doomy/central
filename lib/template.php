<?php

use Template\Directive\DirectiveFactory;
use Template\Directive\DirectiveParser;

class Template {
    private $template_vars;
    private $contents;
	private $component;

    public function __construct($filename = null, $template_vars = null) {
        $this->template_vars = $template_vars;
        if ($filename) {
            $this->contents = $this->read_template_file($filename);
        }
    }

    public function show() {
        $output = $this->process_output();
        echo $output;
    }

    public function process_output($output = null) {
        if(!$output) $output = $this->contents;
        $output = $this->process_variables($output);
        $output = $this->process_nested_directives($output);
        $output = $this->process_simple_directives($output);
        return $output;
    }

	public function attach_component($component) {
		$this->component = $component;
	}

    private function read_template_file($filename) {
        $env = Environment::get_env();

        ob_start();
            foreach($this->template_vars as $template_var_name => $template_var_value)
                ${$template_var_name} = $template_var_value;

            if (file_exists($env->CONFIG['LOCAL_PATH'] . 'templates/' . $filename))
                $fullpath = $env->CONFIG['LOCAL_PATH'] . 'templates/' . $filename;
            else $fullpath = $env->CONFIG['CENTRAL_PATH'] . 'templates/' . $filename;
            include($fullpath);
            $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    private function process_variables($output) {
        $startpos = strpos($output, DirectiveParser::VARIABLE_DELIMITER);
        while($startpos > -1) {
            $endpos = strpos($output, DirectiveParser::VARIABLE_DELIMITER, $startpos+2) + 2;
            $length = $endpos - $startpos;
            $variable_code = substr($output, $startpos, $length);
            $replacement_string = $this->get_variable_replacement_string($variable_code);
            $output = substr_replace($output, $replacement_string, $startpos, $length);
            $startpos = strpos($output, DirectiveParser::VARIABLE_DELIMITER); // next position
        }
        return $output;
    }

    private function get_variable_replacement_string($variable_code) {
        $stripped_variable_code = str_replace("$$", "", $variable_code);
        if (strpos($variable_code, '->') > -1) { // data structure
            return $this->get_property_replacement_string($stripped_variable_code);
        }
        else { // scalar variable
            $variable_name = $stripped_variable_code;
            return isset($this->template_vars[$variable_name]) ? $this->template_vars[$variable_name] : null;
        }
    }

    private function get_property_replacement_string($stripped_variable_code) {
        $parts = explode('->', $stripped_variable_code);
        $variable_name = array_shift($parts);
        $props = $parts;
        $property_name = $props[0];

        if (isset($this->template_vars[$variable_name]))
            $source = $this->template_vars[$variable_name];
        else return '$$'.$stripped_variable_code.'$$';

        $notation = '$source';
        if (is_object($source)) {
            foreach($props as $prop) {
                $notation = $notation . '->'. $prop;
            }
            return eval("return $notation;");
        }
        else {
            foreach($props as $prop) {
                $notation = '[' . $notation . ']'. $prop;
            }
            return eval("return $notation;");
        }
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
                $endpos = $startpos + strlen($replace);
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
