<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\posts\PostsRecord */
/* @var $form yii\widgets\ActiveForm */

//$data=['one','two'];
?>

<div class="posts-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category')->dropDownList(\app\models\posts\PostsRecord::getCategories())

    /* form-control

$form->field($model, 'category')->widget(Select2::classname(), [
        'data' => $data,
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите категорию ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ;*/ ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>