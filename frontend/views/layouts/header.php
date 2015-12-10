<?php
use frontend\models\user;
use frontend\models\Usuario;
use frontend\models\Departamento;
use frontend\models\Motorista;
?>

<header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SGF</b>UFAM</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SGF</b>UFAM</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">

          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
                  <?php

                  global $num;
                  $num=0;

                  $connection = \Yii::$app->db;
                  $model = $connection->createCommand("SELECT * FROM solicitacao WHERE solicitacao.status='Em análise'");
                  $solicitacoes=$model->queryAll();

                  foreach ($solicitacoes as $reg):
                      $num++;
                  endforeach;

                  if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1") {
                      echo " <li class='dropdown messages-menu'>";
                      echo"<a href='#' class='dropdown-toggle' data-toggle='dropdown'>";
                      echo"<i class='fa fa-envelope-o'></i>";
                      echo "<span class='label label-success'>$num</span>";
                  }



                        echo "</a>";
                        echo "<ul class='dropdown-menu'>";

                        if($num==0) {
                            echo "<li class='header'>Não existem novas mensagens</li>";
                        }
                        elseif ($num==1) {
                            echo "<li class='header'>Você possui $num mensagem</li>";
                        }
                        else {
                            echo "<li class='header'>Você possui $num mensagens</li>";
                        }

                        echo "<li>";
                        // inner menu: contains the actual data
                        echo "<ul class='menu'>";

                        $hoje = date("d/m/Y");

                        // Cria uma função que retorna o timestamp de uma data no formato DD/MM/AAAA
                        function geraTimestamp($data) {
                            $partes = explode('/', $data);
                            return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
                        }

                        foreach ($solicitacoes as $reg):
                            $id_usuario = "{$reg['id_usuario']}";
                            $data_lancamento = "{$reg['data_lancamento']}";
                            $lancamento=date('d/m/Y',strtotime($data_lancamento));
                            $id = "{$reg['id']}";

                            $time_inicial = geraTimestamp($lancamento);
                            $time_final = geraTimestamp($hoje);

                            $diferenca = $time_final - $time_inicial;

                            $dias = (int)floor( $diferenca / (60 * 60 * 24));

                            $model = $connection->createCommand("SELECT * FROM user WHERE user.id='$id_usuario'");
                            $usuario = $model->queryAll();
                            foreach ($usuario as $reg):
                                $nome = "{$reg['nome']}";
                                $id_departamento = "{$reg['id_departamento']}";
                            endforeach;

                            $model = $connection->createCommand("SELECT * FROM departamento WHERE id='$id_departamento'");
                            $dep = $model->queryAll();

                            foreach($dep as $reg):
                                $nome_dep =  "{$reg['nome']}";
                            endforeach;

                            echo "<li>"; //<!-- start message -->
                            echo "<a href='index.php?r=solicitacao%2Fview&id=$id'>";
                            echo "<h4>";
                            echo "$nome_dep";
                            if ($dias==0) {
                                echo "<small><i class='fa fa-clock-o'></i> hoje</small>";
                            }
                            elseif ($dias==1) {
                                echo "<small><i class='fa fa-clock-o'></i> ontem </small>";
                            }
                            else {
                                echo "<small><i class='fa fa-clock-o'></i> $dias dias</small>";
                            }
                            echo "</h4>";
                            echo "<p>Uma nova solicitação de <br> $nome </p>";
                            echo "</a>";
                            echo "</li>"; //<!-- end message -->
                        endforeach;
                    ?>
                        <!--<li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="<?=$baseUrl?>/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            AdminLTE Design Team
                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li> -->
                        <!--<li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="<?=$baseUrl?>/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Developers
                            <small><i class="fa fa-clock-o"></i> Today</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>-->
                        <!-- <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="<?=$baseUrl?>/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Sales Department
                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li> -->
                        <!--<li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="<?=$baseUrl?>/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Reviewers
                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>-->
                    </ul>
                  </li>
                    <!-- <li class="footer"><a href="#">See All Messages</a></li> -->
                   </ul>
                 </li>
                 <!-- Notifications: style can be found in dropdown.less -->
                <?php

                    global $count;
                    $count=0;
                    $nome = "";
                    $cnh="";
                    $timestamp = strtotime("+3 months");
                    $data_inicial = date("Y-m-d");
                    $data_final = date('Y-m-d', $timestamp);

                    $connection = \Yii::$app->db;
                    $model = $connection->createCommand("SELECT * FROM motorista WHERE data_validade_cnh>'$data_inicial' AND data_validade_cnh<'$data_final'");
                    $motoristas = $model->queryAll();
                    $model = $connection->createCommand("SELECT * FROM veiculo WHERE status='4'");
                    $veiculos = $model->queryAll();

                    $timestamp = strtotime("+3 months");
                    $data_inicial = date("d/m/Y");
                    $data_final = date('d/m/Y', $timestamp);

                    foreach ($motoristas as $reg):
                        $count++;
                    endforeach;

                    foreach ($veiculos as $reg):
                        $count++;
                    endforeach;

                    if(Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1") {
                        echo "<li class='dropdown notifications-menu'>";
                        echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>";
                        echo "<i class='fa fa-bell-o'></i>";
                        echo"<span class='label label-warning'>$count</span>";
                    }


                    echo "</a>";
                    echo "<ul class='dropdown-menu'>";


                    if ($count==0) {
                        echo"<li class='header'>Não existem novas notificações</li>";
                    }
                    elseif($count==1){
                        echo"<li class='header'>Você possui $count notificação</li>";
                    }
                    else{
                        echo"<li class='header'>Você possui $count notificações</li>";
                    }
                  echo "<li>";
                    // inner menu: contains the actual data
                    echo "<ul class='menu'>";

                        foreach ($motoristas as $reg):
                            $nome = "{$reg['nome']}";
                            $cnh = "{$reg['cnh']}";
                            $validade_cnh = "{$reg['data_validade_cnh']}";
                            $data_final = date('d/m/Y',strtotime($validade_cnh));

                            // Usa a função criada e pega o timestamp das duas datas:
                            $time_inicial = geraTimestamp($data_inicial);
                            $time_final = geraTimestamp($data_final);

                            // Calcula a diferença de segundos entre as duas datas:
                            $diferenca = $time_final - $time_inicial;

                            // Calcula a diferença de dias
                            $dias = (int)floor( $diferenca / (60 * 60 * 24));

                            echo "<li>";
                            echo "<a href='index.php?r=motorista%2Fupdate&id=$cnh'>";
                            echo " <i class='fa fa-user text-yellow'></i> ";
                            if($dias==1) {
                                echo "A carteira do(a) motorista <br> <strong> $nome </strong> vencerá em $dias dia";
                            }
                            else {
                                echo "A carteira do(a) motorista <br> <strong> $nome </strong> vencerá em $dias dias";
                            }
                            echo "</a>";
                            echo " </li>";
                        endforeach;

                        foreach ($veiculos as $reg):
                            $placa = "{$reg['placa_atual']}";
                            $renavam = "{$reg['renavam']}";
                            echo "<li>";
                            echo "<a href='index.php?r=veiculo%2Fupdate&id=$renavam'>";
                            echo " <i class='fa fa-car text-yellow'></i> ";
                            echo "O veículo de placa <br> <strong> $placa </strong> está em manutenção";
                            echo "</a>";
                            echo " </li>";
                        endforeach;

                    echo "</ul>";
                    ?>
                  </li>
              <!-- <li class="footer"><a href="#">View all</a></li>-->
             </ul>
           </li>
           <!--TASKS AQUI-->
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?=$baseUrl?>/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs">
                      <?php
                            if(Yii::$app->user->isGuest){
                                echo "Visitante ";
                            }else{
                                echo Yii::$app->user->identity->username;
                            }
                      ?>

                  </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?=$baseUrl?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                        <?php
                            echo Usuario::findOne(Yii::$app->getUser()->id)->nome;
                        ?>
                      <small>
                          <?php
                            $departamento = Yii::$app->user->identity->id_departamento;
                            if(Yii::$app->user->isGuest){
                              echo "Visitante";
                            }else{
                              echo $departamento = Departamento::findOne($departamento)->nome;
                            }
                          ?>
                      </small>
                    </p>
                  </li>
                  <!-- Menu Body
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li> -->
                  <!-- Menu Footer -->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="index.php?r=site%2Flockscreen" class="btn btn-default btn-danger">Bloquear Tela</a>
                    </div>
                    <div class="pull-right">
                      <a href="index.php?r=site%2Flogout" class="btn btn-default btn-danger">Logout</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->