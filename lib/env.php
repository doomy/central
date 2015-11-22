<?php

class Env {

    # 29/12/14

    public function __construct($basedir) {
        $this->basedir = $basedir;
        //$this->include_packages(array('dir', 'template'));
        $this->_set_env_vars_from_env_files();
    }
    
    public function include_snippet($name, $args = null) {
        $snippet = new Template("snippets/$name.tpl.php");
        $snippet->show($args);
    }

    function _set_env_vars_from_env_files() {
        $files = $this->_get_files_from_env_dir();
        if ($files) {
            $this->_set_env_vars($files);
        }
    }
    
    private function _get_files_from_env_dir() {
        $dir_handler = new Dir($this);
        return $dir_handler->get_files_from_dir_by_extension(
            $this->basedir.'config', 'php'
        );
    }
    
    private function _set_env_vars($files) {
        foreach ($files as $file) {
            include($this->basedir . 'config/'.$file);
        }
        @$this->CONFIG = $CONFIG;
    }
}
?>
