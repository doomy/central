<li>
    <a  <<<if|$text>>> title="$$text$$" <<</if>>> <<<if|$href>>>href="$$href$$"<<</if>>> <<<if|$htmlClass>>>class="$$htmlClass$$"<<</if>>> <<<if|$dataGroup>>>data-group="$$dataGroup$$"<<</if>>> >
        <<<if|$imagePath>>>
            <<<include|component/image.tpl.php>>>
        <<</if>>>
    </a>
</li>