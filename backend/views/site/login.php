<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

/*use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
*/ ?>
<?php
/* @var $this View */
/* @var $form ActiveForm */
/* @var $model LoginForm */

use common\models\LoginForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Login';
?>
<div class="form-box" id="login-box">
    <div class="header">Sign In</div>
    <?php $form = ActiveForm::begin(['id' => 'login-form', 'method' => 'post']); ?>
    <div class="body bg-gray">
        <div class="form-group">
            <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email', 'class' => 'form-control'])->label(false); ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password', 'class' => 'form-control'])->label(false); ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
        </div>
    </div>

    <div class="footer">
        <?= Html::submitButton('Sign in', ['class' => 'btn bg-olive btn-block', 'name' => 'login-button']) ?>
        <?php echo Html::a('Forgot Password', array('site/forgotpassword')); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>