<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use common\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

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
<body class="hold-transition login-page">

        <?php $this->beginBody() ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        <?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>


