<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title='Log in';
?>

<div class="userform text-center">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->input('password') ?>
    <div class="form-group">
        <?= Html::submitButton('Log in', ['class' => 'btn btn-primary', 'name' => 'submit', 'value' => 'Login']) ?>
        <?= Html::submitButton('Sign up', ['class' => 'btn btn-primary', 'name' => 'submit', 'value' => 'Signup']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
