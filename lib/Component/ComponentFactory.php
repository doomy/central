<?php

namespace Component;

use Template;

class ComponentFactory {
	public static function getComponent($componentClass) {
		if($componentClass == Presenter::class) {
			$template = new Template('index.tpl.php', array());
			return new Presenter($template);
		}
	}
}
?>