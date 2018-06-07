<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PetCategory */

$this->title = 'Create Pet Category';
$this->params['breadcrumbs'][] = ['label' => 'Pet Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pet-category-create">
<div class="box box-primary">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
