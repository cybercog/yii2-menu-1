<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model fonclub\menu\models\MenuItem */

$this->title = Yii::t('menu', 'Create {modelClass}', [
    'modelClass' => 'Menu Item',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('menu', 'Menu Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-item-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modulesMenu' => $modulesMenu
    ]) ?>

</div>
