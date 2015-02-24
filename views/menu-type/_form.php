<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model fonclub\menu\models\MenuType */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="menu-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('menu', 'Create') : Yii::t('menu', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
