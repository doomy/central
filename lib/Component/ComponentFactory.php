<?php

namespace Component;

use Template\TemplateFactory;
use Component\Input\TextInput;

class ComponentFactory {

	public static function getComponent($componentClass) {
		$component = new $componentClass();
		$templateFileName = $component->getTemplateFileName();
		$template = TemplateFactory::getTemplate($templateFileName, array());
		$component->assignTemplate($template);

		return $component;
	}
}
?>