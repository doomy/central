<?php

namespace Component;

use Gajus\Dindent\Indenter;
use Dir;

class Presenter extends ContainerComponent {
	protected $templateFileName = 'index.tpl.php';
    public $title;
	public $stylesheets;


    public function setTitle($title) {
        $this->title = $title;
    }

	public function render() {
		$this->addStylesheet('css/style.css');
		$output = parent::render();
		$indenter = new Indenter();
		return $indenter->indent($output);
	}

    public function addStylesheet($cssFile) {
        $this->stylesheets[] = Dir::locate_file($cssFile);
    }
}

?>