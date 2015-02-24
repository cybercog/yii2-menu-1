<?php

namespace fonclub\menu;

use Yii;

/**
 * Class Module
 * @package fonclub\menu
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'fonclub\menu\controllers';

    public function init()
    {
        $this->defaultRoute = "menu-type";

        parent::init();
    }
}