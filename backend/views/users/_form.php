<?php

use common\models\Users;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Users */
/* @var $form ActiveForm */
/*
  ?>

  <div class="users-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'profile_image')->fileInput() ?>

  <?= $form->field($model, 'status')->textInput() ?>

  <div class="form-group">
  <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

  </div>
 */
?>
<div class="box-body">

    <?php
    if (isset($resp['message']))
        echo "<div class='errorMessage'>" . $resp['message'] . "</div>";
    $form = ActiveForm::begin([
                'id' => 'active-form',
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
    ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label('Name<span class="required-label"></span>'); ?>

    <?php echo $form->field($model, 'password')->passwordInput(['maxlength' => true])->label('Password<span class="required-label"></span>'); ?>

    <?php
    if ($model->isNewRecord) {
        $model->status = true;
        $model->profile_image="default.png";
    }
    
    $img = "/uploads/images/" . $model->profile_image;
    ?>

    <?= $form->field($model, 'email')->textInput(['readonly' => !$model->isNewRecord])->label('Email<span class="required-label"></span>'); ?>

    <?= $form->field($model, 'profile_image')->fileInput(); ?>

    <div class="form-group field-pimg">
        <label class="col-sm-2 control-label">Current Profile Picture</label><div class="col-sm-5"><?php echo Html::img($img, ['width' => '80px']); ?></div>
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