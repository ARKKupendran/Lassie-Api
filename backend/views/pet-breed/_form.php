<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PetBreed */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box-body pet-breed-form">
    <?php
    $form = ActiveForm::begin([
                'id' => 'pet-breed-form',
                'enableClientValidation' => true,
                'validateOnSubmit' => true,
                'options' => [
                    'class' => 'form-horizontal',
                    'enctype' => 'multipart/form-data',
                ],
                'fieldConfig' => [
                    'template' => "{label}<div class=\"col-sm-5\">{input}<b style='color: #000;'>{hint}</b><div class=\"errorMessage\">{error}</div></div>",
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                ],
                    ]
    );
     if ($model->isNewRecord) {
        $model->status = true;
     }
    ?>
    
<?= $form->field($model, 'bread_name')->textInput(['maxlength' => true])->label('Bread Name<span class="required-label"></span>'); ?>

<?= $form->field($model, 'status')->checkbox(['label' => ('Active ')])->label('Status') ?>
<div class="box-footer">
        <div class="col-sm-0 col-sm-offset-2">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> &nbsp;&nbsp;
            <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
