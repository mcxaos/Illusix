<?php
/* @var $this yii\web\View */
/* @var $content string */
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-8">Ингредиенты</div>
    <div class="col-md-3">
    <a href=" <?= Url::to(['site/newingredient']);?>">
    	<button class="pull-right btn-primary" >Добавить ингредиент</button> 
    </a>
    </div>
    <div class="col-md-11">
    	<table id='list-table' class="table table-striped">
	    	<tr><th>Ингредиент</th><th>Действия</th></tr>
	    <?php foreach ($ingredients as  $value) :?>
	   	<tr>
	   		<td>  <a href=" <?= Url::to(['site/ingredientview','id'=>$value['id']]);?>"> 
	   		<?= $value['name'];?>
	   		   </a>
	   		</td>
	   		
	  	 	<td> 
	  	 	<a href=" <?= Url::to(['site/ingredientview','id'=>$value['id']]);?>">
	  	 		<span class="glyphicon glyphicon-eye-open"></span>
	  	 	</a>
	  	 	 
	  	 	</td>
	   </tr>
	    <?php endforeach; ?>
	    </table>
		
  </div>
</div>
