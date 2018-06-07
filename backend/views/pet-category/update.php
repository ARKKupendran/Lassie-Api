<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PetCategory */

$this->title = 'Update '.$model->category_name;
$this->params['breadcrumbs'][] = ['label' => 'Pet Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pet_cat_id, 'url' => ['view', 'id' => $model->pet_cat_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
    <div class="box box-primary">
<div class="pet-category-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
    </div>
</div>