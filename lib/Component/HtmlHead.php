<?php
/**
 * Created by PhpStorm.
 * User: doomy
 * Date: 18.2.16
 * Time: 8:46
 */

namespace Component;


class HtmlHead extends Component {
	protected $templateFileName = 'head.twig';
	public $jsFiles;
	public $name = 'HtmlHead';

	public function addJsFile($filename, $external = false) {
		$jsFile = new \stdClass();
		$jsFile->fileName = $filename;
		$jsFile->external = $external;
		$this->jsFiles[] = $jsFile;
	}
}