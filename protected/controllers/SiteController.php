<?php
namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Recipe;
use app\models\Ingredient;
use app\models\RecipeIngredient;


class SiteController extends MainController
{
    /* 
    Метод  отображения таблицы с рецептами
    */
    public function actionIndex()
    {
       
        $recipe = recipe ::findAll(['user_id' =>Yii::$app->user->getId()]);

        return $this->render('index', ['recipe' =>$recipe,
        ]);
    }

     /* 
    Метод  обработки ошибок
    */
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            Yii::$app->response->statusCode=$exception->statusCode;
            return $this->render('error', ['exception' => $exception]);
        }
    }

    /* 
    Метод  отображения ингредиентов по всем рецептам пользователя
    */
    public function actionIngredientsview()
    {

        $recipes = recipe ::findAll(['user_id' =>Yii::$app->user->getId()]);
            return $this->render('ingredients', ['ingredients' =>$this->Ingredients($recipes),
        ]);
    }



    /* 
    Метод  создания нового ингредиента
    */
    public function actionNewingredient(){
        $model  = new Ingredient();
        $post = Yii::$app->request->post();
        $name = $post['Ingredient']['name'];
        if(Ingredient::findByName($name) == null){
            $model->name=$name;
            if($model->validate())
            {
                $model->save();
          
            }
        }
        return $this->render('newingredient', ['model' =>$model,
        ]);
    }

    /* 
    Метод  отображения рецептов у ингредиента
    */
    public function actionIngredientview($id = null)
    {
        if ($id == null){
            return $this->actionIndex();
        } 
        $RecipeIngredient = RecipeIngredient ::findAll(['ingredient_id' =>$id]);
        $recipe = [];
        foreach ($RecipeIngredient as $key => $value) {
           $recipe[] = $value ->getRecipe()->one();
        }
        return $this->render('index', ['recipe' =>$recipe,]);
    }

    /* 
    Метод  отображения ингредиентов по выбраным рецептам пользователя
    */
    public function actionOrder()
    {
        $post = Yii::$app->request->post();
        $recipes = Recipe :: find()->where(['id' =>$post['checkbox']])->orderBy('id')
        ->all();
         return $this->render('ingredients', ['ingredients' =>
            $this->Ingredients($recipes),
        ]);
    }

    /* 
    Метод  поиска ингредиентов   рецептам пользователя
    */
    private function Ingredients($recipes)
    {
         $Ingredientlist=[];
         foreach ($recipes as $recipe) {
               $RecipeIngredients = RecipeIngredient ::findAll(['recipe_id'=>$recipe->getId()]);
               foreach ($RecipeIngredients as $RecipeIngredient) {
                 $Ingredientlist[]= $RecipeIngredient->getIngredient()->one();
               }
         }
         return $Ingredientlist;
    }

    /* 
    Метод  отображения рецепта
    */
    public function actionRecipeview( $id=null )
    {
        if ($id == null){
            return $this->actionIndex();
        }
        $recipe = recipe :: findOne(['id'=>$id]);
        $RecipeIngredient = RecipeIngredient ::findAll(['recipe_id' =>$id]);
        return $this->render('recipeview',['recipe' => $recipe,'RecipeIngredient'=>$RecipeIngredient]);
    }

    /* 
    Метод добовления рецепта
    */
    public function actionRecipe()
    {
        $newRecipe = new Recipe();
        return $this->render('recipe', [
         'model' => $newRecipe,
         'ingredient'=>$newIngredient ,
         'RecipeIngredient'=>$newRecipeIngredient,
        ]);
    }

    /* 
    Метод добовления рецепта с помощью ajax
    */
    public function actionRecipeajax()
    {

        $post = Yii::$app->request->post();
        $recipe = new recipe();
        if($recipe ->load($post['Recipe'])){
            $id = $recipe->getId();
            $Ingredient = new Ingredient();
            return $Ingredient->load($id,json_decode($post['ingredients'], true));
       }
    }

}
