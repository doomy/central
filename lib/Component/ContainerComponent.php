<?php

namespace Component;

abstract class ContainerComponent extends Component {
	protected $children;

	public function setChildren(array $children) {
		$this->children = $children;
	}

	public function addChild(Component $child) {
		$this->children[] = $child;
	}
}

?>