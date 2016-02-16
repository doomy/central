<?php

namespace Component;
use Template;

abstract class Component {
	protected $template;
	protected $templateFileName;
    public $htmlClass;
    public $dataGroup;
	public $name;

	public function __construct() {}

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

	public function hasChildren() {
		return false;
	}

	public function setName($name) {
		$this->name = $name;
	}

    public function addTemplateVars($template_vars) {
        $this->template->addTemplateVars($template_vars);
    }
}