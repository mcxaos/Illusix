<?php
namespace app\models;

use yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class Recipe extends ActiveRecord  
{
  
    /**
     * @return string название таблицы, сопоставленной с этим ActiveRecord-классом.
     */
    public static function tableName()
    {
        return 'Recipe';
    }

    public function rules()
    {
        return [
          
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['desc', 'filter', 'filter' => 'trim'],
            ['desc', 'required'],
            ['desc', 'string', 'min' => 2, 'max' => 255],
        
        ];
    }
   
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'desc' => 'Описание',
          
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
     * Finds recipe by name
     *
     * @param  string      $name
     * @return static|null
     */
    public static function findByName($name)
    {
        return static::findOne(['name' => $name]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getIngredients()
    {
        return $this->hasMany(RecipeIngredient::className(), ['recipe_id' => 'id']);
    }

    public function load($post)
    {
        $this->name = $post['name'];
        $this->desc = $post['desc'];
        $this->user_id = Yii::$app->user->getId();
        if(!$this->validate()){
            $this->addErrors($this->errors);
            return false;
        }else {
            return $this->save();
        }
    }
}
