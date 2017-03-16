<?php
namespace app\models;

use yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class Ingredient extends ActiveRecord  
{
  
    /**
     * @return string название таблицы, сопоставленной с этим ActiveRecord-классом.
     */
    public static function tableName()
    {
        return 'Ingredient';
    }

    public function rules()
    {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],
        ];
    }
   
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
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
     * Finds  by name
     *
     * @param  string      $name
     * @return static|null
     */
    public static function findByName($name)
    {
        return static::findOne(['name' => $name]);
    }

    public static function getName()
    {
      return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getResepiec()
    {
        return $this->hasMany(RecipeIngredient::className(), ['ingredient_id' => 'id']);
    }


    public function load($rec_id,$ing_array)
    {
        foreach ($ing_array as $key => $value) {
            if($this->findByName($value['name']) == null){
                $Ingredient = new Ingredient();
                $Ingredient ->name = $value['name'];
              if(! $Ingredient ->validate()){
                        $this->addErrors( $Ingredient ->errors);
                        return false;
                }
                 $Ingredient ->save();
                $id =  $Ingredient ->getId();
            }
            else {
                $id =  $this->findByName($value['name'])->getId();
            }
            
           $RecipeIngredient = new RecipeIngredient();
           $RecipeIngredient->quantity = $value['quantity'];
           $RecipeIngredient->recipe_id=$rec_id;
           $RecipeIngredient->ingredient_id=$id;
           if( !$RecipeIngredient->validate()){
                $this->addErrors($RecipeIngredient->errors);
                return false;
           }
           else
           {
               return $RecipeIngredient->save();
           } 
        }
        return true;
    }
}
