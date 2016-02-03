<?php

namespace Component;

class Presenter extends ContainerComponent {
    public $title;

    function setTitle($title) {
        $this->title = $title;
    }
}

?>