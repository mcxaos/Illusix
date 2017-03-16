<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
$identity=$this->params['identity'];
?>
<nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/">
                            <img src="/public/img/star_6307.png" width="18">
                            <?= Html::encode('Site')?>
                        </a>
                    </li>
                 
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($identity===null): ?>
                        <li><?= Html::a('Login', Url::toRoute(['/auth',])); ?></li>
                    <?php else: ?>
                        <li><?= Html::a('Logout', Url::toRoute(['/auth/logout',])); ?></li>
                    <?php endif; ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
</nav>