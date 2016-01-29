<?php

namespace Component;

abstract class ContainerComponent extends Component {
	protected $children;

	public function setChildren(array $children) {
		$this->children = $children;
	}

	public function addChild($child) {
		$this->children[] = $child;
	}
}

?>