<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\posts\PostsRecord */

$this->title = 'Update Posts Record: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Posts Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="posts-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
