<?php
use yii\widgets\Breadcrumbs
?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?= $this->title ?>
			<!--small>Description</small-->
		</h1>
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
	</section>7
	
	<!-- Main Content -->
	<section class="content">
		<?= $content ?>
	</section> <!-- /.content -->
</div> <!-- /.content-wrapper -->