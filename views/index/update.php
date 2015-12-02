<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\Widgets\ActiveForm;

 ?>

 <a href="<?= Url::toRoute("index/mostrar") ?>"> Mostrar registro</a>
   <h2> Editar registro de usuarios con ID : <?= Html::encode($_GET["id_reg"]) ?> </h2>

 <?php $form = ActiveForm::begin([
 	"method"=>"post",
 	"enableClientValidation"=>"true",
 	]);
  ?>


  <h3><?= $mensaje ?></h3>
 <div class="containar">
 	<div class="form-group">
		
			<?= $form->field($model, "id_reg")->input("hidden")->label("false") ?>
		
	
	</div>
		
	<div class="form-group">
		
			<?= $form->field($model, "nombre")->input("text") ?>
		
	
	</div>

	<div class="form-group ">
		
			<?= $form->field($model, "apellido")->input("text") ?>
		
	</div>

	<div class="form-group">
		
			<?= $form->field($model, "CI")->input("text") ?>
		
	</div>

	<div class="form-group">
			
			<?= $form->field($model, "email")->input("email") ?>
		
	</div>

	<div class="form-group">
	
			<?= $form->field($model, "usuario")->input("text") ?>
		
	</div>

	<div class="form-group">
		
			<?= $form->field($model, "clave")->input("text") ?>
	

	</div>
	
		


<?= Html::submitButton("enviar", ["class"=>"btn btn-primary"]) ?>

<?php $form->end() ?>
