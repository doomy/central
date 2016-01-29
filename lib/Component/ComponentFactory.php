<?php

namespace Component;

use Template;

class ComponentFactory {
	private static $template_map = array(
		Presenter::class => 'index.tpl.php'
	);

	public static function getComponent($componentClass) {
		$template = new Template(self::$template_map[$componentClass], array());
		if($componentClass == Presenter::class) {
			return new Presenter($template);
		}
	}
}
?>