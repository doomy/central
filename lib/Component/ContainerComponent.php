<?php

namespace Component;

class ContainerComponent extends Component {
	protected $children;
	protected $templateFileName = "component/container.tpl.php";

	public function setChildren(array $children) {
		$this->children = $children;
	}

	public function addChild($child) {
		$this->children[] = $child;
	}

	public function getChildren() {
		return $this->children;
	}
}

?>