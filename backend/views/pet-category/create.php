<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PetCategory */

$this->title = 'Create Pet Category';
$this->params['breadcrumbs'][] = ['label' => 'Pet Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pet-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
