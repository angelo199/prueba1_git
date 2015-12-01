<?php  
namespace app\models;

use Yii;
use yii\base\model;

class FormMostrar extends model{

public $b;

	public function rules(){
		return [

			["b","match","pattern"=>"/^[0-9a-z]+$/i","message"=>"Solo se aceptan letras y numeros"],

		];
	}

	public function attributeLabels(){

		return [
		"b"=>"Buscar"
		];

	}
}