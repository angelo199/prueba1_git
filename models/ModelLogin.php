<?php 
namespace app\models;

use Yii;
use yii\base\Model;
class ModelLogin extends Model{

	public $usuario;
	public $clave;

	public function rules(){
		return [
			[["usuario","clave"], 'required','campos requeridos'],

		];
	}

	public function attributeLabes(){

		return [
		"usuario"=>"Usuario",
		"clave"=>"Contraseña",
		];
	}

}