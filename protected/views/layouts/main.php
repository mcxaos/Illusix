<?php
/* @var $this yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);

//$this->params['identity'];
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="/public/img/favicon.ico" type="image/x-icon" />
    <?php $this->head() ?>
</head>

<body class="main-body">
    <?php $this->beginBody() ?>
        <header class="header"><?= $this->render('pageHeader') ?></header>
        <div class="row">
        <?php if($this->params['identity'] != null):?>
  			<div class="col-sm-2"><?= $this->render('menu') ?></div>
            <div class="content col-sm-10">
        <?php else: ?><div class="content col-sm-12"> <?php endif;?>
 			<?= $content ?></div>
 		</div>
    <?php $this->endBody() ?>
</body>

</html>

<?php $this->endPage() ?>