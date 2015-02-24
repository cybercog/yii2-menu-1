<?php

namespace fonclub\menu;

use Yii;

/**
 * Class MenuClass
 * @package fonclub\menu
 */

class MenuClass
{

    /**
     * @return array
     */
    public static function init()
    {
        $items = [
            'name' => Yii::t('backend', 'System pages'),
            'routers' => [
                [
                    'name' => Yii::t('frontend', 'Contact'),
                    'url' => '/site/contact'
                ],
                [
                    'name' => Yii::t('frontend', 'Login'),
                    'url' => '/site/login'
                ],
                [
                    'name' => Yii::t('frontend', 'Logout'),
                    'url' => '/site/logout'
                ],
                [
                    'name' => Yii::t('frontend', 'Signup'),
                    'url' => '/site/signup'
                ],
                [
                    'name' => Yii::t('frontend', 'Javascript void'),
                    'url' => 'javascript:void();'
                ]
            ]
        ];

        return $items;
    }

    /**
     * @return array
     */
    public static function adminInit()
    {
        $items = [
            [
                'label' => Yii::t('backend', 'Content'),
                'icon' => '<i class="fa fa-edit"></i>',
                'options' => ['class' => 'treeview'],
                'items' => [
                    ['label' => Yii::t('backend', 'Static pages'), 'url' => ['/pages/admin/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                    ['label' => Yii::t('backend', 'Text Widgets'), 'url' => ['/widget-text/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                ]
            ],
            [
                'label' => Yii::t('backend', 'Users'),
                'icon' => '<i class="fa fa-users"></i>',
                'url' => ['/users/default'],
                'visible' => Yii::$app->user->can('administrator')
            ],
            [
                'label' => Yii::t('backend', 'System'),
                'icon' => '<i class="fa fa-cogs"></i>',
                'options' => ['class' => 'treeview'],
                'items' => [
                    [
                        'label' => Yii::t('backend', 'i18n'),
                        'icon' => '<i class="fa fa-flag"></i>',
                        'options' => ['class' => 'treeview'],
                        'items' => [
                            ['label' => Yii::t('backend', 'i18n Source Message'), 'url' => ['/i18n/i18n-source-message/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => Yii::t('backend', 'i18n Message'), 'url' => ['/i18n/i18n-message/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                        ]
                    ],
                    ['label' => Yii::t('backend', 'Languages'), 'icon' => '<i class="fa fa-language"></i>', 'url' => ['/languages/default/index']],
                    [
                        'label' => Yii::t('backend', 'Site menu'),
                        'icon' => '<i class="fa fa-bars"></i>',
                        'url' => ['/menu/menu-type/index'],
                        'options' => ['class' => 'treeview'],
                        'items' => [
                            ['label' => Yii::t('backend', 'Menu types'), 'icon' => '<i class="fa fa-bars"></i>', 'url' => ['/menu/menu-type/index']],
                            ['label' => Yii::t('backend', 'Menu items'), 'icon' => '<i class="fa fa-bars"></i>', 'url' => ['/menu/menu-item/index']]
                        ]
                    ],
                    ['label' => Yii::t('backend', 'Router rules'), 'icon' => '<i class="fa fa-link"></i>', 'url' => ['/router/default/index']],
                ]
            ]
        ];

        return $items;
    }
}

