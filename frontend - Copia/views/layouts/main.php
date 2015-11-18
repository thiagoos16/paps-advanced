<?php
/* @var $this \yii\web\View */
/* @var $content string */
use frontend\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
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
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <!--    --><?php
    NavBar::begin([
        'brandLabel' => 'Sistema de Transportes da PCU',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login']] :
                [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <div class="row">
            <div class="col-sm-3">
                <div class="sidebar-nav">
                    <div class="navbar navbar-default" role="navigation">
                        <div class="navbar-header">

                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <span class="visible-xs navbar-brand">Sidebar menu</span>
                        </div>
                        <div class="navbar-collapse collapse sidebar-navbar-collapse">

                            <ul class="nav navbar-nav">
                                <li class="active"><?php echo Html::a("Home",['site/index'])?></li>
                                <!-- <li><?php echo Html::a("Sobre",['site/about'])?></li>-->
                                <!-- <li><?php echo Html::a("Contato",['site/contact'])?></li>-->
                                <li><?php echo Html::a("Marca", ['marca/index']) ?></li>
                                <li><?php echo Html::a("Modelo", ['modelo/index']) ?></li>
                                <li><?php echo Html::a("Motorista",['motorista/index'])?></li>
                                <li><?php echo Html::a("Tipo Combustível",['tipo-combustivel/index'])?></li>
                                <li><?php echo Html::a("Posto Abastecimento",['posto-abastecimento/index'])?></li>
                                <li><?php echo Html::a("Cor",['cor/index'])?></li>
                                <li><?php echo Html::a("Veículo",['veiculo/index'])?></li>
                                <li><?php echo Html::a("Departamento",['departamento/index'])?></li>
                                <li><?php echo Html::a("Usuarios",['usuario/index'])?></li>
                                <li><?php echo Html::a("Abastecimento",['abastecimento/index'])?></li>
                                <li><?php echo Html::a("Categoria de Veículo",['categoria-veiculo/index'])?></li>
                                <li><?php echo Html::a("Manutenção",['manutencao/index'])?></li>
                                <!-- <li><?php echo Html::a("Login",['site/login'])?></li> -->
                                <li><a href="#">Solicitações <span class="badge">10</span></a></li>
                                <li class="active">
                                    <a href="#" data-toggle="collapse" data-target="#toggleDemo2" data-parent="#sidenav01" class="collapsed">
                                        <span class=""></span> Gastos <span class="caret pull-right"></span>
                                    </a>
                                    <div class="collapse" id="toggleDemo2" style="height: 0px;">
                                        <ul class="nav nav-list">
                                            <li><?php echo Html::a("Abastecimento", ['abastecimento/index']) ?></li>
                                            <li><?php echo Html::a("Manutencao", ['manutencao/index']) ?></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Icomp - Instituto de Computação</p>

        <p class="pull-right" >Desenvoldido no contexto da disciplina IEC112 - 2015/02</p>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
