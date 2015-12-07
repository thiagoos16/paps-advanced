<?php
use frontend\models\Departamento;
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

                <!-- USUÁRIO -->
                <p>
                    <?php
                    if(Yii::$app->user->isGuest){
                        echo "Visitante";
                    }else{
                        echo Yii::$app->user->identity->username;
                    }
                    ?>
                </p>

                <!-- DEPARTAMENTO -->
                <a>
                    <?php
                    $departamento = Yii::$app->user->identity->id_departamento;
                    if(Yii::$app->user->isGuest){
                        echo "Visitante";
                    }else{
                        echo $departamento = Departamento::findOne($departamento)->nome;
                    }
                ?>
                </a>

            </div>
          </div>
          <!-- search form -->
            <?php
            if (Yii::$app->user->isGuest) {
                echo Html::a('Login', ['/site/login'], ['class' => 'btn btn-block btn-danger', 'data-method' => 'post']);
            }else{
                echo Html::a('Logout', ['/site/logout'], ['class' => 'btn btn-block btn-danger', 'data-method' => 'post']);
                echo Html::a('Bloquear Tela', ['/site/lockscreen'], ['class' => 'btn btn-block btn-danger', 'data-method' => 'post']);
            }
            ?>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU</li>

              <li>
                  <a href="index.php?r=solicitacao/index">
                      <i class="fa fa-comment"></i> <span>Solicitações</span>
                  </a>
              </li>

              <li>
                  <a href="index.php?r=resposta-solicitacao/index">
                      <i class="fa fa-comments"></i> <span>Responder Solicitação</span>
                  </a>
              </li>

              <li class="treeview">
                  <a href="#">
                      <i class="fa fa-money"></i> <span>Gastos</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">

                      <li>
                          <a href="index.php?r=abastecimento/index">
                              <i class="fa fa-dashboard"></i> <span>Abastecimentos</span>
                          </a>
                      </li>

                      <li>
                          <a href="index.php?r=manutencao/index">
                              <i class="fa fa-wrench"></i> <span>Manutenções</span>
                          </a>
                      </li>
                  </ul>
              </li>

              <li class="treeview">
                  <a href="#">
                      <i class="fa fa-car"></i> <span>Veículos</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">

                      <li>
                          <a href="index.php?r=cor/index">
                              <i class="fa fa-dashboard"></i> <span>Cores</span>
                          </a>
                      </li>

                      <li>
                          <a href="index.php?r=marca/index">
                              <i class="fa fa-bus"></i> <span>Marcas</span>
                          </a>
                      </li>

                      <li>
                          <a href="index.php?r=modelo/index">
                              <i class="fa fa-truck"></i> <span>Modelos</span>
                          </a>
                      </li>

                      <li>
                          <a href="index.php?r=tipo-combustivel/index">
                              <i class="fa fa-motorcycle"></i> <span>Tipos de Combustível</span>
                          </a>
                      </li>

                      <li>
                          <a href="index.php?r=veiculo/index">
                              <i class="fa fa-car"></i> <span>Veículos</span>
                          </a>
                      </li>
                  </ul>
              </li>

              <li>
                  <a href="index.php?r=motorista/index">
                      <i class="fa fa-user"></i> <span>Motoristas</span>
                  </a>
              </li>

              <li>
                  <a href="index.php?r=posto-abastecimento/index">
                      <i class="fa fa-dashboard"></i> <span>Postos de Abastecimento</span>
                  </a>
              </li>

              <li>
                  <a href="index.php?r=departamento/index">
                      <i class="fa fa-briefcase"></i> <span>Departamentos</span>
                  </a>
              </li>

              <li>
                  <a href="index.php?r=usuario/index">
                      <i class="fa fa-users"></i> <span>Usuários</span>
                  </a>
              </li>

              <li>
                  <a href="#">
                      <i class="fa fa-newspaper-o"></i> <span>Relatório Anual</span>
                  </a>
              </li>

          </ul>

        </section>
        <!-- /.sidebar -->
      </aside>

      