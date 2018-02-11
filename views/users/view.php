<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\users\UsersRecord */
//vd($data);
//vd($model);
$this->title = $data->username;
$this->params['breadcrumbs'][] = ['label' => 'Users Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="users-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $data->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $data->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php


    /*DetailView::widget([
        'model' => $model,
        'attributes' => [
            'users.id',
            'users.username',
            'users.email',

        ],
    ])*/
    //foreach($model->posts as $pst) {
    //echo $pst->title;}


    ?>

    <p>
        <?= GridView::widget([
            'dataProvider' => $model,
            'columns' => [
                'id',
                'title',
                'body:ntext',
                [
                    'attribute' => 'username',
                    'value' => function($data) {
            //vd($data);
                        return Html::tag('b',Html::a(Html::encode($data['username']), ['users/view', 'id'=>$data['u_id']]));
                    },
                    'format' => 'Html',
                ],

                ['class' => 'yii\grid\ActionColumn',
                    'controller'=> 'posts',


                ],
            ]
        ]); ?>

    </p>

</div>
