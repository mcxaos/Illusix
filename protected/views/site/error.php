<?php
use yii\helpers\Html;
$this->title = $exception->statusCode.'('.$exception->getMessage().')';
//print_r($exception)
?>
<div class="text-center">
    <div class="h3">   <?= Html::encode($exception->statusCode) ?></div>
    <div class="h3">   <?= Html::encode($exception->getMessage()) ?></div>
</div>
