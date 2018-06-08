<?php

use common\models\PetCategory;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model PetCategory */
/* @var $form ActiveForm */
/*
?>

<div class="pet-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
*/?>
<div class="box-body">
    <?php
    $form = ActiveForm::begin([
                'id' => 'pet-category-form',
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
        //$model->category_image="default.jpg";
        $catimg_lable="Default Category Picture";
     }
     else{
         $catimg_lable="Current Category Picture";
     }
     
     $model->category_image=(empty($model->category_image)) ? "default.jpg" : $model->category_image;
     $img = "/uploads/petcat/" . $model->category_image;
    ?>
    
<?= $form->field($model, 'category_name')->textInput(['maxlength' => true])->label('Category Name<span class="required-label"></span>'); ?>
    
<?= $form->field($model, 'category_image')->fileInput(); ?>
    
<div class="form-group field-pimg">
        <label class="col-sm-2 control-label"><?php echo $catimg_lable;?></label><div class="col-sm-5"><?php echo Html::img($img, ['width' => '80px']); ?></div>
</div>    

<?= $form->field($model, 'status')->checkbox(['label' => ('Active ')])->label('Status') ?>
<div class="box-footer">
        <div class="col-sm-0 col-sm-offset-2">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> &nbsp;&nbsp;
            <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>