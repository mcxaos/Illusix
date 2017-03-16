<?php
/* @var $this yii\web\View */
/* @var $content string */

//var_dump($value->getIngredient()->one());

use yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-11">
    <div style="padding-bottom: 10px"><?= $recipe['name']?></div>
 	<div style="padding-bottom: 20px"><?= $recipe['desc']?></div>
 	<div>Ингредиенты</div>
 	<hr/>
 	
 	<?php  foreach ($RecipeIngredient as $key => $value):?>
 	
 		 <a href=" <?= Url::to(['site/ingredientview',
 		 'id'=>$value->getIngredient()->one()->getId(),
 		 ]);?>">
 		<div class="col-md-8"> <?= $value->getIngredient()->one()->name;?></div>
 		</a>
 		<div class="col-md-3"> <?= $value->quantity;?></div>
 	<?php endforeach;?>
    </div>
   	
   	
  </div>
</div>
