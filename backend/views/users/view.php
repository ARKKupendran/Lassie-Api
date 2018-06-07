<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = "View".' '.$model->username." Details";
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <!--<h1><?= Html::encode($this->title.' '.$model->username." Details") ?></h1>-->

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
            'auth_key',
            'password',
            'email:email',
            //'profile_image',
            [
                'attribute' => 'profile_image',
                'format' => 'html',
                'label' => 'Profile Picture',
                'value' => function ($data) {
                    return Html::img('/uploads/images/' . $data['profile_image'], ['width' => '60px']);
                },
            ],
            [
                'class' => 'backend\components\StatusColumn',
                'attribute' => 'status',
            ],
        ],
    ]) ?>

</div>
