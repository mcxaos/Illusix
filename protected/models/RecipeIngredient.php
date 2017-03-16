<?php
namespace app\models;

use yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class RecipeIngredient extends ActiveRecord  
{
  
    /**
     * @return string название таблицы, сопоставленной с этим ActiveRecord-классом.
     */
    public static function tableName()
    {
        return 'RecipeIngredient';
    }

    public function rules()
    {
        return [
            ['quantity', 'filter', 'filter' => 'trim'],
            ['quantity', 'required'],
            ['quantity', 'string', 'min' => 2, 'max' => 255],
        ];
    }
   
    public function attributeLabels()
    {
        return [
            'quantity' => 'Количество',
        ];
    }
    /** INCLUDE USER name VALIDATION FUNCTIONS**/
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getRecipe()
    {
        return $this->hasOne(Recipe::className(), ['id' => 'recipe_id']);
    }
    public function getIngredient()
    {
        return $this->hasOne(Ingredient::className(), ['id' => 'ingredient_id']);
    }
    
}
