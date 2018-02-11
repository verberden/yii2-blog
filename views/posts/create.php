<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\posts\PostsRecord */

$this->title = 'Create Posts Record';
$this->params['breadcrumbs'][] = ['label' => 'Posts Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>

<script>
    $(document).ready(function() {
        $("#postsrecord-category").select2();
    });
</script>
