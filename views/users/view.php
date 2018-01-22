<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\users\UsersRecord */
//vd($data);
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$id = 1;

?>
<div class="users-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email',

        ],
    ]) ?>

    <p>
        <?= GridView::widget([
            'dataProvider' => $data,
            'columns' => [
                'id',
                'title',
                'body:ntext',

                ['class' => 'yii\grid\ActionColumn',
                    'controller'=> 'posts',


                ],
            ]
        ]); ?>


    </p>

</div>
