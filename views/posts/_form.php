<?php

use yii\helpers\Html;
use  yii\web\View;
use yii\widgets\ActiveForm;
use app\assets\ImgcorpAsset;

ImgcorpAsset::register($this);

$script = <<< JS
//jQuery("#target").on('mouseover', 
jQuery("#imgInp").change(function(event) {
    function preview(img, selection) {

   jQuery('#x1').val(selection.x1);
   jQuery('#y1').val(selection.y1);
   jQuery('#x2').val(selection.x2);
   jQuery('#y2').val(selection.y2);    
}

    var ias = jQuery('#target').imgAreaSelect({ instance: true });
    ias.setSelection(50, 50, 250, 250, true);
    ias.setOptions({ handles: false,
        maxHeight: 200,
        maxWidth: 200,
        minHeight: 200,
        minWidth: 200,
        fadeSpeed: 200,
        show: true, 
        onSelectChange: preview });

        ias.update();

});
JS;
$this->registerJs($script, View::POS_END);


/* @var $this yii\web\View */
/* @var $model app\models\posts\PostsRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-record-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'imageFile')->fileInput(['id' => 'imgInp']) ?>

    <div>
        <img id="target" src="#" alt="your image" />
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <div>
        <?= Html::label('X1', ['id' => 'x1']) ?><?= Html::input('text', 'x1', null, ['id' => 'x1']) ?><br>
        <?= Html::label('Y1', ['id' => 'y1']) ?><?= Html::input('text', 'y1', null, ['id' => 'y1']) ?><br>
        <?= Html::label('X2', ['id' => 'x2']) ?><?= Html::input('text', 'x2', null, ['id' => 'x2']) ?><br>
        <?= Html::label('Y2', ['id' => 'y2']) ?><?= Html::input('text', 'y2', null, ['id' => 'y2']) ?><br>
    </div>

    <?php ActiveForm::end(); ?>

</div>
