<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\posts\PostsRecord */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-record-view">

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
        'model' => $username,
        'attributes' => [


            [                                                  // the owner name of the model
                'label' => 'Автор.',
                'captionOptions'=>[ 'style'=>'width: 300px'],
                'value' => function($username) use ($id) {
                            return Html::tag('b',Html::a(Html::encode($username['username']), ['users/view', 'id' => $id], [
                                'title' => 'My Super Link',
                                'target' => '_blank',
                                'alt' => 'Link to Super Website',
                            ] ));
                            },
                'format' => 'Html',


            ],
        ],

    ]) ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'title',
            'body:ntext',
        ],
    ]) ?>

</div>
