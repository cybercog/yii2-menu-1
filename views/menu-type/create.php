<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model fonclub\menu\models\MenuType */

$this->title = Yii::t('menu', 'Create {modelClass}', [
    'modelClass' => 'Menu Type',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('menu', 'Menu Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
