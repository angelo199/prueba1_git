<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;


?>
<h1>Mostrar</h1>

<a class="btn btn-default" href="<?= Url::toRoute("index/create") ?>">Inicio a la pagina principal</a>
<br><br>
<?php  $f = ActiveForm::begin([
	"method"=>"get",
	"action"=> Url::toRoute("index/mostrar"),
	"enableClientValidation"=> true,
	]);
?>

<div class="form-group col-sm-3">
	
<?= $f->field($form, "b")->input("text") ?>
<?= Html::submitButton("buscar", ["class"=>"btn btn-primary"])  ?><br><br>

</div>



<?php $f->end() ?>
<table class ="table table-border">
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>CI</th>
		<th>Email</th>
		<th>Usuario</th>
		<th>Contraseña</th>
		<th>Accion</th>
	</tr>
		<?php foreach($model as $row ): ?>
	<tr>
		<td> <?= $row->id_reg ?> </td>
		<td> <?= $row->nombre ?> </td>
		<td> <?= $row->apellido ?> </td>
		<td> <?= $row->CI ?> </td>
		<td> <?= $row->email ?> </td>
		<td> <?= $row->usuario ?> </td>
		<td> <?= $row->clave ?> </td>
		<td> <a class="btn btn-success" href=" <?= Url::toRoute(["index/update", "id_reg"=>$row->id_reg]) ?>">Modificar</a> </td> 
		<td>
		  <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#id_reg_<?= $row->id_reg ?>">Eliminar</a>
            <div class="modal fade" role="dialog" aria-hidden="true" id="id_reg_<?= $row->id_reg ?>">
                      <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Eliminar alumno</h4>
                              </div>
                              <div class="modal-body">
                                    <p>¿Realmente deseas eliminar al alumno con id <?= $row->id_reg ?>?</p>
                              </div>
                              <div class="modal-footer">
                              <?= Html::beginForm(Url::toRoute("index/delete"), "POST") ?>
                                    <input type="hidden" name="id_reg" value="<?= $row->id_reg ?>">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Eliminar</button>
                              <?= Html::endForm() ?>
                              </div>
                            </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
	</tr>

	
	<?php endforeach ?>

</table>

	
	<?= LinkPager::widget([

    "pagination" => $pages,

	]);

	?>

