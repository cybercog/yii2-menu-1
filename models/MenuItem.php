<?php

namespace fonclub\menu\models;

use Yii;
use common\components\behaviors\multilingual\MultilingualBehavior;
use common\components\behaviors\multilingual\MultilingualQuery;

/**
 * Class MenuItem
 * @package fonclub\menu\models
 */
class MenuItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_type_id', 'url', 'visible', 'data_method'], 'required'],
            [['menu_type_id', 'parent_id'], 'integer'],
            [['status'], 'string'],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'ml' => [
                'class' => MultilingualBehavior::className(),
                'languages' => [
                    'ru' => 'Русский',
                    'en' => 'English',
                ],
                'langClassName' => \fonclub\menu\models\MenuItemLang::className(),
                'langForeignKey' => 'menu_item_id',
                'tableName' => "{{%menu_item_lang}}",
                'attributes' => ['title'],
                'rules' => [
                    [['title'], 'required'],
                    [['title'], 'string', 'max' => 255],
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('menu', 'ID'),
            'menu_type_id' => Yii::t('menu', 'Menu Type ID'),
            'parent_id' => Yii::t('menu', 'Parent ID'),
            'url' => Yii::t('menu', 'Url'),
            'status' => Yii::t('menu', 'Status'),
            'visible' => Yii::t('menu', 'Visible'),
            'data_method' => Yii::t('menu', 'Data method'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuType()
    {
        return $this->hasOne(MenuType::className(), ['id' => 'menu_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(MenuItemLang::className(), ['menu_item_id' => 'id']);
    }

    /**
     * @return array
     */
    public function getMenuTypes(){
        $menuTypes = [];

        foreach( \fonclub\menu\models\MenuType::find()->all() as $type )
            $menuTypes[$type->id] = $type->name;

        return $menuTypes;
    }

    /**
     * @return array
     */
    public function getParentList(){
        $parents = [];
        $titleField = 'title_'.Yii::$app->language;

        foreach( $this->findAll(['status'=>'1']) as $item)
            $parents[$item->id] = $item->$titleField;

        return $parents;
    }

    /**
     * @return MultilingualQuery
     */
    public static function find()
    {
        $q = new MultilingualQuery(get_called_class());
        $q->multilingual();
        return $q;
    }
}
