<?php
/* @var $this yii\web\View */
/* @var $content string */
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-8">Мои рецепты</div>
    <div class="col-md-3">
    <a href=" <?= Url::to(['site/recipe']);?>">
    	<button class="pull-right btn-primary" >Добавить рецепт</button> 
    </a>
    </div>
    <div class="col-md-11">
    <?php  $form = ActiveForm::begin(['id' => 'form-list','action'=>Url::to(['site/order'])]); ?>
    	<table id='list-table' class="table table-striped">
	    	<tr><th>Рецепт</th><th>Описание</th><th>Действия</th></tr>
	    <?php foreach ($recipe as $key => $value) :?>
	   	<tr>
	   		<td>  <a href=" <?= Url::to(['site/recipeview','id'=>$value['id']]);?>"> 
	   		<?= $value['name'];?>
	   		   </a>
	   		</td>
	   		<td> <?= substr($value['desc'],0,10);?>...</td>
	  	 	<td> 
	  	 	<a href=" <?= Url::to(['site/recipeview','id'=>$value['id']]);?>">
	  	 		<span class="glyphicon glyphicon-eye-open"></span>
	  	 	</a>
	  	 	 	<input type="checkbox" name='checkbox[]' value="<?=$value['id'];?>"> 
	  	 	</td>
	   </tr>
	    <?php endforeach; ?>
	    </table>		
	    	<button id='create-list' class='pull-right btn-primary'>
	    		Составить список
	    	</button>
	    <?php ActiveForm::end(); ?>
  </div>
</div>
