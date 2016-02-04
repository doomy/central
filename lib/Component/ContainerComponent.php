<?php

namespace Component;

class ContainerComponent extends Component {
	protected $children;
	protected $templateFileName = "component/container.tpl.php";

	public function __construct() {
		parent::__construct();
	}

	public function setChildren(array $children) {
		$this->children = $children;
	}

	public function addChild($child) {
		$this->children[] = $child;
	}

	public function getChildren() {
		return $this->children;
	}

	public function hasChildren() {
		return true;
	}

	public function getChildrenByClass($class) {
		$children = array();
		foreach($this->children as $child) {
			if(get_class($child) == $class);
			$children[] = $child;
			if ($child->hasChildren()) {
				$foundGrandChildren = $child->getChildrenByClass($class);
				$children = array_merge($children, $foundGrandChildren);
			}
		}
		return $children;
	}

	public function getChildByName($name) {
		foreach($this->children as $child) {
			if($child->name == $name) return $child;
			if($child->hasChildren()) {
				$child = $child->getChildByName($name);
				if($child) return $child;
			}
		}
		return false;
	}
}

?>