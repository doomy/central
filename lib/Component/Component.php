<?php

namespace Component;
use Template;

abstract class Component {
	protected $template;
    public $htmlClass;
    public $dataGroup;

	public function __construct(Template $template) {
		$this->template = $template;
		$this->template->attach_component($this);
	}

	public function render() {
		return $this->template->process_output();
	}

    public function setTemplate($template) {
        $this->template = $template;
    }

    public function setHtmlClass($htmlClass) {
        $this->htmlClass = $htmlClass;
    }

    public function setDataGroup($dataGroup) {
        $this->dataGroup = $dataGroup;
    }
}