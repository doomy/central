<?php

namespace Component;

class Table extends Component {
	protected $templateFileName = 'component/table.twig';

	public $keys;
	public $rows;

	public function setData($assocData) {
		$this->rows = array();
		$this->keys = array_keys($assocData[0]);
		foreach ($assocData as $row) {
			$newRow = array();
			foreach($this->keys as $key) {
				$newRow[] = $row[$key];
			}
			$this->rows[] = $newRow;
		}
	}

}