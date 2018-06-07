<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PetCategory */

$this->title = 'Update Pet Category: ' . $model->pet_cat_id;
$this->params['breadcrumbs'][] = ['label' => 'Pet Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pet_cat_id, 'url' => ['view', 'id' => $model->pet_cat_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pet-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
