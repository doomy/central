<?php

namespace Component;

use Gajus\Dindent\Indenter;
use Environment;

class Presenter extends ContainerComponent {
	protected $templateFileName = 'index.tpl.php';
    public $title;
	public $css_path;

    public function setTitle($title) {
        $this->title = $title;
    }

	public function render() {
		$env = Environment::get_env();
		$this->css_path = $env->CONFIG['CENTRAL_PATH'].'css/style.css';
		$output = parent::render();
		$indenter = new Indenter();
		return $indenter->indent($output);
	}
}

?>