<?php
use yii\helpers\Url;
?>
   <div class="sidebar-nav">
      <div class="navbar" role="navigation">
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
          <ul class="left-menu nav navbar-nav">
            <li><a href="/">Мои рецепты</a></li>
            <hr />
            <li><a href="#">Мои меню</a></li>
            <hr />
            <li><a href=" <?= Url::to(['site/ingredientsview']);?>">Ингридиенты</a></li>
            <hr />
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
