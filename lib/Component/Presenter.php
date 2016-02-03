<?php

namespace Component;

use Gajus\Dindent\Indenter;

class Presenter extends ContainerComponent {
	protected $templateFileName = 'index.tpl.php';
    public $title;

    public function setTitle($title) {
        $this->title = $title;
    }

	public function render() {
		$output = parent::render();
		$indenter = new Indenter();
		return $indenter->indent($output);
	}
}

?>