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
	protected $hiddenChild = true;

	public function addJsFile($filename, $external = false) {
		$jsFile = new \stdClass();
		$jsFile->fileName = $filename;
		if ((strpos($filename, 'http') === 0)
			|| (strpos($filename, '//') === 0)) {
			$external = true;
		}
		$jsFile->external = $external;
		$env = \Environment::get_env();
		if ($env->CONFIG['DISABLE_REMOTE'] && $external) return false;
		$this->jsFiles[] = $jsFile;
	}
}