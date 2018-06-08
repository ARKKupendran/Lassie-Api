<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PetCategory */

$this->title = "View".' '.$model->category_name;
$this->params['breadcrumbs'][] = ['label' => 'Pet Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pet-category-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pet_cat_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pet_cat_id], [
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
            'pet_cat_id',
            'category_name',
            [
                'attribute' => 'category_image',
                'format' => 'html',
                'label' => 'Category Picture',
                'value' => function ($data) {
                    if(empty($data['category_image']))
                        $petcat="default.jpg";
                    else
                        $petcat=$data['category_image'];
                    return Html::img('/uploads/petcat/'.$petcat, ['width' => '60px','height'=>'60px']);
                },
                'headerOptions' => ['width' => '100'],
            ],
            //'created_at',
            //'updated_at',
            [
              'label' => 'Created On',
              'attribute' =>'created_at',
              'format' => ['date', 'php:Y/m/d H:i A'],
            ],
            [
              'label' => 'Updated On',
              'attribute' =>'updated_at',
              'format' => ['date', 'php:Y/m/d H:i A'],
            ],
            [
                'class' => 'backend\components\StatusColumn',
                'format' => 'html',
                'attribute' => 'status',
                'value' => function ($data) {
                    if($data['status']==1)
                        return '<span style="font-size:85%;" class="label success"> Active </span>';
                    else
                        return '<span style="font-size:85%;" class="label failure"> In Active </span>';
                }
            ],
        ],
    ]) ?>

</div>
