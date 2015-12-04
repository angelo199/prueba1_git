<?php 

namespace app\models;

use Yii;
use yii\base\model;

class FormUpdate extends model
{	
	public $id_reg;
	public $nombre;
	public $apellido;
	public $CI;
	public $email;
	public $clave;
	public $usuario;



	
	public function rules(){
		return [
			['id_reg', 'integer', 'message' => 'Id incorrecto'],		
 			[['nombre','apellido','CI','email','usuario','clave'],'required','message'=>'Campos requeridos'],
 			['nombre', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
 			['nombre','match','pattern'=>"/^[0-9a-z]+$/i",'message'=>'Sólo se aceptan letras y números'],
 			['CI','match','pattern'=>"/^[0-9a-z]+$/i",'message'=>'solo se aceptan letras y numero'],
 		];

	}

	public function attributeLabels(){
 		return [
 		"id_reg" => "Id_reg",
 		"nombre" => "Nombre",
 		"apellido" => "apellido",
 		"CI" => "CI",
 		"email" => "Email",
 		"usuario" => "Usuario",
 		"clave" => "Clave",
 		];
 	}
}
