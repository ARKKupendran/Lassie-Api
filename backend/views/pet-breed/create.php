<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PetBreed */

$this->title = 'Create Pet Breed';
$this->params['breadcrumbs'][] = ['label' => 'Pet Breeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pet-breed-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
