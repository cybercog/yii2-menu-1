<div class="menu-module-view row">
    <?php
    foreach ($paths as $values) {
        if (empty($values['routers']))
            continue;
        ?>
        <div class="col-xs-6 col-md-4">
            <h4><?= $values['name'] ?></h4>
            <ul>
            <?php
            foreach ($values['routers'] as $routeRule) { ?>
                <li>
                    <a class="menu-module-type" href="javascript:;" data-url="<?= $routeRule['url'] ?>"
                       data-action="<?= $routeRule['action'] ?>"><?= $routeRule['name'] ?></a>
                </li>
            <?php } ?>
            </ul>
        </div>
    <?php } ?>
</div>
<div id="selectParams"></div>