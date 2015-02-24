<?php

use yii\helpers\Html;
use yii\grid\GridView;
use fonclub\menu\models\MenuItem;

/* @var $this yii\web\View */
/* @var $searchModel fonclub\menu\models\search\MenuItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('menu', 'Menu Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-item-index">

    <p>
        <?= Html::a(Yii::t('menu', 'Create {modelClass}', [
    'modelClass' => 'Menu Item',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php \yii\widgets\Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'title_'.Yii::$app->language,
                'format' => 'text',
                //'filter' => false
            ],
            [
                'attribute' => 'menu_type_id',
                'format' => 'html',
                'value' => function($model){
                    return '<span class="label label-success">' . MenuItem::getMenuTypes()[$model->menu_type_id] . '</span>';
                },
                'filter' => Html::activeDropDownList($searchModel, 'menu_type_id', MenuItem::getMenuTypes(), ['class' => 'form-control', 'prompt' => Yii::t('backend', 'Menu type')])
            ],
            'parent_id',
            'url:url',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($model){
                    if ($model->status == 1) {
                        $class = 'label-success';
                    } elseif ($model->status == 0) {
                        $class = 'label-danger';
                    }
                    $status = ( $model->status == 1 ) ? 'on' : 'off';
                    return '<span class="label ' . $class . '">' . $status . '</span>';
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', [
                    0 => 'off',
                    1 => 'on'
                ], ['class' => 'form-control', 'prompt' => Yii::t('backend', 'Status')])
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end() ?>
</div>
