<?php

namespace Component;


class Link extends Component {
    public $href;
    public $text;

    public function setHref($href) {
        $this->href = $href;
    }

    public function setText($text) {
        $this->text = $text;
    }
}

?> 