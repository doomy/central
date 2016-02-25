<?php
/**
 * Created by PhpStorm.
 * User: doomy
 * Date: 25.2.16
 * Time: 8:59
 */

namespace Component;

use Component\StaticComponent;

class ExternalComponent extends StaticComponent {
	public function assignTemplate($template) {
		parent::assignTemplate($template);
		$this->template->setRemote(true);
	}
}