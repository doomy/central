<?php

namespace Component;

use Gajus\Dindent\Indenter;
use Dir;
use Component\ComponentFactory;
use Component\HtmlHead;

class Presenter extends ContainerComponent {
	protected $templateFileName = 'index.tpl.php';
    public $title;
	public $stylesheets;

	public function __construct() {
		parent::__construct();
		$this->addChild(ComponentFactory::getComponent(HtmlHead::class));
	}


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

	public function addJsFile($filename, $external = false) {
		$htmlHead = array_shift($this->getChildrenByClass(HtmlHead::class));
		$htmlHead->addJsFile($filename, $external);
	}
}

?>