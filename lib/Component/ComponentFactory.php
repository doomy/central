<?php

namespace Component;

use Template;
use Component\Input\TextInput;

class ComponentFactory {

	public static function getComponent($componentClass) {
		$component = new $componentClass();
		$templateFileName = $component->getTemplateFileName();
		$template = new Template($templateFileName, array());
		$component->assignTemplate($template);

		return $component;
	}
}
?>