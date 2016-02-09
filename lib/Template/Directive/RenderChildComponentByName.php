<?php

namespace Template\Directive;


class RenderChildComponentByName extends ComponentDirective {
    public function render($template_vars) {
        if($this->component && $this->component->hasChildren()) {
            $component = $this->component->getChildByName($this->parameters[0]);
            return $component->render();
        }
        return null;
    }

}

?> 