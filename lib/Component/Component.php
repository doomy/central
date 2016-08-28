<?php

namespace Component;
use Template;

abstract class Component {
	protected $template;
	protected $templateFileName;
	protected $hiddenChild = false;
    public $htmlClass;
    public $dataGroup;
	public $name;
	public $title;

	public function __construct() {}

    public function __get($property) {
        die("getting");
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

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

	public function setTitle($title) {
		$this->title = $title;
	}

	public function isHiddenChild() {
		return $this->hiddenChild;
	}
}