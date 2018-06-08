<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PetBreed */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pet-breed-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'main_cat_id')->textInput() ?>

    <?= $form->field($model, 'bread_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
