<?php
use frontend\models\Departamento;
use yii\helpers\Html;
use frontend\models\user;
use frontend\models\Usuario;
?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?=$baseUrl?>/dist/img/ufam.png" class="img-circle" alt="User Image">
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
            }

            /*else{
                echo Html::a('Logout', ['/site/logout'], ['class' => 'btn btn-block btn-danger', 'data-method' => 'post']);
                echo Html::a('Bloquear Tela', ['/site/lockscreen'], ['class' => 'btn btn-block btn-danger', 'data-method' => 'post']);
            }*/
            ?>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU PRINCIPAL</li>

              <li>
                  <a href="index.php?r=solicitacao/index&sort=-id">
                      <i class="fa fa-comment"></i> <span>Solicitações</span>
                  </a>
              </li>

              <li class="treeview">
                  <?php
                  if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1") {
                      echo "<a href=''#'>";
                      echo "<i class='fa fa-money'></i> <span>Gastos</span> <i class='fa fa-angle-left pull-right'></i>";
                      echo "</a>";
                  }
                  ?>

                  <ul class="treeview-menu">

                      <li>
                          <?php
                          if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1")
                              //echo Html::a("Abastecimentos",['abastecimento/index']);
                              echo "<a href='index.php?r=abastecimento/index&sort=-id'>Abastecimentos</a>";


                          ?>
                      </li>

                      <li>
                          <?php
                          if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1")
                              echo "<a href='index.php?r=manutencao/index&sort=-id'>Manutenções</a>";
                              //echo Html::a("Manutenções",['manutencao/index']);

                          ?>
                      </li>
                  </ul>
              </li>

              <li class="treeview">
                  <?php
                  if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1") {
                      echo "<a href='#'>";
                      echo "<i class='fa fa-car'></i> <span>Veículos</span> <i class='fa fa-angle-left pull-right'></i>";
                      echo "</a>";
                  }
                  ?>

                  <ul class="treeview-menu">

                      <li>
                          <?php
                          if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1")
                              echo Html::a("Cores",['cor/index']);

                          ?>
                      </li>
                      <li>
                          <?php
                          if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1")
                              echo Html::a("Marcas",['marca/index']);

                          ?>
                      </li>
                      <li>
                          <?php
                          if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1")
                              echo Html::a("Modelos",['modelo/index']);

                          ?>
                      </li>
                      <li>
                          <?php
                          if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1")
                              echo Html::a("Combustível",['tipo-combustivel/index']);

                          ?>
                      </li>
                      <li>
                          <?php
                          if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1")
                              echo Html::a("Veículos",['veiculo/index']);

                          ?>
                      </li>
                  </ul>
              </li>

              <li>
                  <?php
                  if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1") {
                      echo "<a href='index.php?r=motorista/index'>";
                      echo "<i class='fa fa-user''></i> <span>Motoristas</span>";
                      echo "</a>";
                  }
                  ?>
              </li>

              <li>
                  <?php
                  if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1") {
                      echo "<a href='index.php?r=posto-abastecimento/index'>";
                      echo "<i class='fa fa-dashboard''></i> <span>Postos de Abastecimento</span>";
                      echo "</a>";
                  }
                  ?>
              </li>

              <li>
                  <?php
                  if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1") {
                      echo "<a href='index.php?r=departamento/index'>";
                      echo "<i class='fa fa-briefcase''></i> <span>Departamentos</span>";
                      echo "</a>";
                  }
                  ?>
              </li>

              <li>
                  <?php
                  if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1") {
                      echo "<a href='index.php?r=usuario/index'>";
                      echo "<i class='fa fa-users''></i> <span>Usuários</span>";
                      echo "</a>";
                  }
                  ?>
              </li>

              <li>
                  <?php
                  if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1") {
                      echo "<a href='index.php?r=relatorio/create'>";
                      echo "<i class='fa fa-newspaper-o''></i> <span>Relatório Anual</span>";
                      echo "</a>";
                  }
                  ?>
              </li>

          </ul>

        </section>
        <!-- /.sidebar -->
      </aside>

      