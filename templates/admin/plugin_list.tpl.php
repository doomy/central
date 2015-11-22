<ul class="centered-content">
    <?php
    foreach($modules as $index => $module) {
        echo "<li><a href='?plugin_id=".$index."'>".$module->template_vars['title']."</a></li>";
    } ?>
</ul>
