<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\users\UsersRecord */

$this->title = 'Новый пользователь';
$this->params['breadcrumbs'][] = ['label' => 'Users Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
