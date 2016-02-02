<?php

namespace Component;

use Template;
use Component\Input\TextInput;

class ComponentFactory {
	private static $template_map = array(
		Presenter::class => 'index.tpl.php',
		Form::class		 => 'component/form.tpl.php',
		TextInput::class => 'component/input/text_input.tpl.php'
	);

	public static function getComponent($componentClass) {
		$template = new Template(self::$template_map[$componentClass], array());
		if($componentClass == Presenter::class) {
			return new Presenter($template);
		}
		elseif($componentClass == Form::class) {
			return new Form($template);
		}
		elseif ($componentClass == TextInput::class) {
			return new TextInput($template);
		}
	}
}
?>