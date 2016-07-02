<?php

namespace Model;


use base\Model;

class Entity extends Model {
    protected $table;
    protected $columns;

    public function save()
    {
        $property_names = [];
        $values = [];

        foreach($this->columns as $column) {
            $property_names[] = $column;
            $values[] = "'".$this->{$column}."'";
        }

        $property_names_in = implode(", ", $property_names);
        $values_in = implode(", ", $values);
        $sql = "REPLACE INTO {$this->table} ($property_names_in) VALUES($values_in)";
        $this->mysqli->query($sql);
    }

    public function getMaxId() {
        $result = $this->mysqli->query("SELECT MAX(id) max_id FROM {$this->table}");
        $row = $result->fetch_object();
        return $row->max_id;
    }
}

?> 