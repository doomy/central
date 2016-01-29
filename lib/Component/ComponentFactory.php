<?php

namespace Component;

class ComponentFactory {
	public static function getComponent($componentClass) {
		if($componentClass == Presenter::class) {
			$template = new Template('index.tpl.php');
			return new Presenter($template);
		}
	}
}
?>