<?php

namespace fonclub\menu\models;

use Yii;

/**
 * Class MenuItemLang
 * @package fonclub\menu\models
 */
class MenuItemLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu_item_lang}}';
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItem()
    {
        return $this->hasOne(MenuItem::className(), ['id' => 'menu_item_id']);
    }
}
