<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title='Добавление ингредиента';
?>

<div class="col-sm-6">
    <?php  $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name') ?>
    <hr />
    <div class="form-group pull-right">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary',
         'name' => 'submit', 'value' => 'add']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>