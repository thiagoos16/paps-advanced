<?php
use yii\helpers\Html;
?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?=$baseUrl?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Admin</p>
              <a href="#">Icomp</a>
            </div>
          </div>
          <!-- search form -->
            <?php
            if (Yii::$app->user->isGuest) {
                echo Html::a('Login', ['/site/login'], ['class' => 'btn btn-block btn-danger', 'data-method' => 'post']);
            }else{
                echo Html::a('Logout', ['/site/logout'], ['class' => 'btn btn-block btn-danger', 'data-method' => 'post']);
            }
            ?>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU</li>
              <li>
                  <a href="index.php?r=marca/index">
                      <i class="fa fa-dashboard"></i> <span>Marca</span>
                  </a>
              </li>

              <li>
                  <a href="index.php?r=modelo/index">
                      <i class="fa fa-dashboard"></i> <span>Modelo</span>
                  </a>
              </li>

              <li>
                  <a href="index.php?r=motorista/index">
                      <i class="fa fa-dashboard"></i> <span>Motorista</span>
                  </a>
              </li>

              <li>
                  <a href="index.php?r=tipo-combustivel/index">
                      <i class="fa fa-dashboard"></i> <span>Tipo de Combustível</span>
                  </a>
              </li>

              <li>
                  <a href="index.php?r=posto-abastecimento/index">
                      <i class="fa fa-dashboard"></i> <span>Posto de Abastecimento</span>
                  </a>
              </li>

              <li>
                  <a href="index.php?r=cor/index">
                      <i class="fa fa-dashboard"></i> <span>Cor</span>
                  </a>
              </li>

              <li>
                  <a href="index.php?r=veiculo/index">
                      <i class="fa fa-dashboard"></i> <span>Veículo</span>
                  </a>
              </li>

              <li>
                  <a href="index.php?r=departamento/index">
                      <i class="fa fa-dashboard"></i> <span>Departamento</span>
                  </a>
              </li>

              <li>
                  <a href="index.php?r=usuario/index">
                      <i class="fa fa-dashboard"></i> <span>Usuário</span>
                  </a>
              </li>

              <li>
                  <a href="index.php?r=categoria-veiculo/index">
                      <i class="fa fa-dashboard"></i> <span>Categoria de Veículo</span>
                  </a>
              </li>

              <li>
                  <a href="index.php?r=manutencao/index">
                      <i class="fa fa-dashboard"></i> <span>Manutenção</span>
                  </a>
              </li>

              <li>
                  <a href="index.php?r=abastecimento/index">
                      <i class="fa fa-dashboard"></i> <span>Abastecimento</span>
                  </a>
              </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      