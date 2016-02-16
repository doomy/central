<?php

namespace Template\Directive;


class RenderChildComponentByName extends ComponentDirective {
    public function render($template_vars) {
        if($this->component && $this->component->hasChildren()) {
            $component = $this->component->getChildByName($this->parameters[0]);
            $component->addTemplateVars($template_vars);
            return $component->render();
        }
        return null;
    }

}

?> 