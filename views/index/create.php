<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<h1>create</h1>
<?= $mensaje ?>
<?php $form = ActiveForm::begin([
	"method" => "post",
	"enableClientValidation"=>true,
]);
?>
	<div class="containar">
		
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