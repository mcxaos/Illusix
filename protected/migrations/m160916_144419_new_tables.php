<?php

use yii\db\Schema;
use yii\db\Migration;
use app\models\Role;

class m160916_144419_new_tables extends Migration
{
    public function up()
    {
        if (!in_array('User', $this->getDb()->schema->tableNames)) {$this->CreateUsers();};
        if (!in_array('Recipe', $this->getDb()->schema->tableNames)) {$this->CreateRecipe();};
        if (!in_array('Ingredient', $this->getDb()->schema->tableNames)) {$this->CreateIngredient();};
        if (!in_array('CreateRecipeIngredient', $this->getDb()->schema->tableNames)) {
            $this->CreateRecipeIngredient();
        };
    }

    public function down()
    {
        echo "m160916_144419_new_tables cannot be reverted.\n";

        return false;
    }   

    private function CreateUsers()
    {
        $this->createTable('User', [
                'id' => $this->primaryKey(),
                'username' => $this->string()->notNull()->unique(),
                'email' => $this->string()->notNull()->unique(),
                'password' => $this->string()->notNull(),
                'auth_key' => $this->string()->notNull(),
                'password_reset_token' => $this->string(),
                'active' => $this->integer()->notNull()->defaultValue('1'),
            ]);
    }

    private function CreateRecipe()
    {

        $this->createTable('Recipe', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'desc' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);
           $this->addForeignKey(
            'fk-recipe-user_id',
            'Recipe',
            'user_id',
            'User',
            'id',
            'CASCADE'
        );
    }

    private function CreateIngredient()
    {

        $this->createTable('Ingredient', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }
    
    private function CreateRecipeIngredient()
    {

        $this->createTable('RecipeIngredient', [
            'ingredient_id' => $this->integer()->notNull(),
            'recipe_id' => $this->integer()->notNull(),
            'quantity' => $this->string()->notNull(),
        ]);
        $this->addForeignKey(
            'fk-recipeIng-ing_id',
            'RecipeIngredient',
            'ingredient_id',
            'Ingredient',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-recipeIng-recipe_id',
            'RecipeIngredient',
            'recipe_id',
            'Recipe',
            'id',
            'CASCADE'
        );
    }




    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
