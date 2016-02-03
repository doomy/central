<?php

namespace Component;
use Template;

abstract class Component {
	protected $template;
	protected $templateFileName;
    public $htmlClass;
    public $dataGroup;

	public function assignTemplate(Template $template) {
		$this->template = $template;
	}

	public function render() {
		$this->template->attach_component($this);
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

	public function getTemplateFileName() {
		return $this->templateFileName;
	}
}