<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

 <?= $mensaje ?>
<?php $form = ActiveForm::begin([
	"method"=>"post",
	"enableClientValidation"=>true,
	]); 
?>

<div class="container">
	<div class="form-group">
		<?= $form->field($model, "usuario")->input("text") ?>
	</div>
	<div class="form-group">
		<?= $form->field($model, "clave")->input("password") ?>
	</div>

	<?= Html::submitButton("Ingresar", ["class"=>"btn btn-primary"])?>

</div>

<?php $form->end() ?>


