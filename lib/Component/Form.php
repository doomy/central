<?php

namespace Component;
use Component\ContainerComponent;

class Form extends ContainerComponent {
    public $submitText = 'send';
	protected $templateFileName = 'component/form.tpl.php';
}