<?php

use yii\helpers\Html;
use yii\grid\GridView;
//vd($dataProvider);
/* @var $this yii\web\View */
/* @var $searchModel app\models\posts\PostsSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts Records';
$this->params['breadcrumbs'][] = $this->title;
//vd($dataCategories);
?>
<div class="posts-record-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Posts Record', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'body:ntext',
            [

                    'attribute'=>'category',
                    'value'=> function($data) use ($dataCategories) {
                            foreach ($dataCategories as $key =>$value){
                                if ($key==$data['category']) {
                                        return Html::encode($value);
                                }                            }
                                //vd($data);

                    },
                ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>


