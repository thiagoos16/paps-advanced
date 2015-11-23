<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

$asset = AppAsset::register($this);
$baseUrl = $asset->baseUrl
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="skin-blue fixed">
<?php $this->beginBody() ?>

<div class="wrap">
    <?= $this->render('header.php',['baseUrl' => $baseUrl]) ?>
	<?= $this->render('leftmenu.php',['baseUrl' => $baseUrl]) ?>
	<?= $this->render('content.php',['content' => $content]) ?>
	<?= $this->render('footer.php',['baseUrl' => $baseUrl]) ?>
	<?= $this->render('rightside.php',['baseUrl' => $baseUrl]) ?>
	
	<div class="control-sidebar-bg"></div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
