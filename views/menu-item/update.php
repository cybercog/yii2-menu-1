<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model fonclub\menu\models\MenuItem */

$this->title = Yii::t('menu', 'Update {modelClass}: ', [
    'modelClass' => 'Menu Item',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('menu', 'Menu Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('menu', 'Update');
?>
<div class="menu-item-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modulesMenu' => $modulesMenu
    ]) ?>

</div>
