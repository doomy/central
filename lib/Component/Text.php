<?php
/**
 * Created by PhpStorm.
 * User: doomy
 * Date: 5.2.16
 * Time: 12:47
 */

namespace Component;


class Text extends StaticComponent {
	protected $templateFileName = 'component/text.tpl.php';
	public $text;

	public function setText($text) {
		$this->text = $text;
	}
}