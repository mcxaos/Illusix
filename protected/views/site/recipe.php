<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->registerJsFile(
    '@web/public/js/ingredient.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title='Добавление рецепта';
?>
<span>Добавление рецепта</span>
<div>

<div class="col-sm-6">
    <?php  $form = ActiveForm::begin(['id' => 'form-recipe',]); ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'desc')->textarea(['rows' => 6, 'cols' => 5])?>
    <hr />
    <div id='ingredients'>
        <div class="col-sm-6">
            <span>Ингредиент</span>
            <div id='ingredient-name'></div>
        </div>
        <div class="col-sm-6">
            <span>Количество</span>
            <div id='ingredient-quantity'></div>
        </div>
    </div>
        <div id="ingredient-add" class = 'btn btn-primary'>Добавить ингредиент</div>
     <hr />
    <div class="form-group pull-right">
        <?= Html::submitButton('Добавить', ['id'=>'add-recipe', 'class' => 'btn btn-primary', 'name' => 'submit', 'value' => 'add']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>