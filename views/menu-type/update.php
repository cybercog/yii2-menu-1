<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model fonclub\menu\models\MenuType */

$this->title = Yii::t('menu', 'Update {modelClass}: ', [
    'modelClass' => 'Menu Type',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('menu', 'Menu Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('menu', 'Update');
?>
<div class="menu-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
