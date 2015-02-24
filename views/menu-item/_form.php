<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use \common\models\Languages;

/* @var $this yii\web\View */
/* @var $model fonclub\menu\models\MenuItem */
/* @var $form yii\bootstrap\ActiveForm */
$languages = Languages::find()->all();

$this->registerJs("
    $('#select-menu').on('click', function(){
        $('#modules-menu').toggle();
        $('#selectParams').empty();
    });

    $('.menu-module-type').on('click', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        var action = $(this).data('action');

        if(action !== ''){
            $('#selectParams').load(action, function() {
                $('#selectParams select').on('change', function(){
                    var query = $(this).find(':selected').data('query');
                    $('#menuitem-url').val(url+'?'+query);
                });
            });
        }
        else
            $('#menuitem-url').val(url);
    });
    ");

?>

<div class="menu-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $form->errorSummary($model); ?>

    <?php
    foreach ($languages as $language) {
        $items[$language->name] = [
            'label' => $language->name,
            'active' => Yii::$app->language == $language->url,
            'content' =>
                $form->field($model, 'title_' . $language->url)->textInput(['maxlength' => 255]),
            'options' => ['id' => 'tab_' . $language->url],
        ];
    }
    echo Tabs::widget(['items' => $items]);
    ?>

    <?php echo $form->field($model, 'menu_type_id')->dropDownList($model->getMenuTypes())->label(Yii::t('menu', 'Menu type')) ?>

    <?php echo $form->field($model, 'parent_id')->dropDownList($model->getParentList(), ['prompt' => ''])->label(Yii::t('menu', 'Parent menu')) ?>

    <?php echo Html::a(Yii::t('menu', 'Select item'), 'javascript:;', ['class' => 'btn btn-success', 'id' => 'select-menu']) ?>

    <div id="modules-menu" style="display: none">
        <?php echo $modulesMenu ?>
    </div>

    <hr/>

    <?php echo $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'visible')->dropDownList(['all' => 'All', 'notuser' => 'Not user', 'user' => 'Users', 'administrator' => 'Admin']) ?>

    <?php echo $form->field($model, 'data_method')->dropDownList(['get' => 'get', 'post' => 'post']); ?>

    <?php echo $form->field($model, 'status')->dropDownList(['0', '1',], ['prompt' => '']) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('menu', 'Create') : Yii::t('menu', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
