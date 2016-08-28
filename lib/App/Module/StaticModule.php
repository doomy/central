<?php

namespace App\Module;

use Template;
use Component\ComponentFactory;
use Component\StaticComponent;
use Environment;

class StaticModule {
    const TEMPLATE_MAP_CONFIG_ALIAS = 'STATIC_TEMPLATE_MAP';

    protected $templateMap;

    public function __construct() {
        $this->templateMap = Environment::getConfig(self::TEMPLATE_MAP_CONFIG_ALIAS);
    }

    public function getStaticContentTemplate($action = null) {
        $filename = (isset($action) && $action) ? $this->templateMap[$action] : $this->templateMap['default'];
        return new Template($filename, array());
    }

    public function getStaticComponent($action = null) {
        $template = $this->getStaticContentTemplate($action);
        $staticComponent = ComponentFactory::getComponent(StaticComponent::class);
        $staticComponent->setTemplate($template);
        return $staticComponent;
    }
}