<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\helpers\Url;

use app\models\ModelRegistro;
use app\models\Registro;
use app\models\ModelLogin;
use app\models\FormMostrar;
use app\models\FormUpdate;




class IndexController extends Controller
{
    public function actionUpdate(){
        $model =new FormUpdate;
        $mensaje = null;

     if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $table = Registro::findOne($model->id_reg);
                if($table)
                {
                    $table->nombre = $model->nombre;
                    $table->apellido = $model->apellido;
                    $table->CI = $model->CI;
                    $table->email = $model->email; 
                    if ($table->update())
                    {
                        $mensaje = "El Alumno ha sido actualizado correctamente";
                    }
                    else
                    {
                        $mensaje = "El Alumno no ha podido ser actualizado";
                    }
                }
                else
                {
                    $mensaje = "El alumno seleccionado no ha sido encontrado";
                }
            }
            else
            {
                $model->getErrors();
            }
        }

        if (Yii::$app->request->get("id_reg"))
        {
            $id_reg = Html::encode($_GET["id_reg"]);
            if ((int) $id_reg)
            {
                $table = Registro::findOne($id_reg);
                if($table)
                {
                        $model->id_reg = $table->id_reg;
                        $model->nombre =  $table->nombre;
                        $model->apellido = $table->apellido;
                        $model->CI =$table->CI;
                        $model->email =$table->email;
                        $model->usuario =$table->usuario;
                        $model->clave = $table->clave;

                }
                else
                {
                    return $this->redirect(["index/mostrar"]);
                }
            }
            else
            {
                return $this->redirect(["index/mostrar"]);
            }
        }
        else
        {
            return $this->redirect(["index/mostrar"]);
        }
      
        return $this->render("update",["model"=>$model, "mensaje"=>$mensaje]);
    }

    public function actionDelete(){
        if (Yii::$app->request->post()) {
            
            $id_reg = Html::encode($_POST["id_reg"]);
            
            if ((int) $id_reg) {
                if (Registro::deleteAll("id_reg=:id_reg", [":id_reg"=> $id_reg])){
                    echo " Alumno con Id = $id_reg eliminado con exito";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("index/mostrar")."'>";
                }else{
                     echo "Ha ocurrido un error al eliminar el registro";
                     echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("index/mostrar")."'>";
           
                } 

            }else{
                echo "Ha ocurrido un error al eliminar el registro";
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("index/mostrar")."'>";
            }

        }else{
            return $this->redirect(["index/mostrar"]);
        }
    }

    public function actionCreate(){

    	$model =new ModelRegistro;
    	$mensaje = null;
    	if ($model->load(yii::$app->request->post())) {
    		if ($model->validate()) {
    			$tabla =new Registro;
					$tabla->nombre = $model->nombre;
					$tabla->apellido = $model->apellido;
					$tabla->CI = $model->CI;
					$tabla->email = $model->email;
					$tabla->usuario = $model->usuario;
					$tabla->clave = $model->clave;

					if ($tabla->insert()) {
						$mensaje ="registro exitoso";
						$model->nombre =null;
						$model->apellido =null;
						$model->CI =null;
						$model->email =null;
						$model->usuario =null;
						$model->clave =null;
					}else{
						$mensaje ="no se registro";
					}
    			
    		}else{
    			    $model->getErrors();
    		}
    	}

     return $this->render("create",["model"=>$model,"mensaje"=>$mensaje]);

    }

    public function actionLogin(){
        $mensaje =null;
    	$model = new ModelLogin;

        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()){
                $mensaje="Correcto";

                $query="SELECT *FROM registras WHERE usuario ='' AND clave=''";

            }else{
                $mensaje="Invalido";
            }
        }else{
            $model->getErrors();
        }

    	return $this->render("login");
    }

    public function actionMostrar(){
        
        /*$table = new Registro;
        $model = $table->find()->all();
        $form =new FormMostrar;
        $buscar= null;

        if ($form->load(Yii::$app->request->get())) {
            if ($form->validate()) {
               $buscar = Html::encode($form->b);
               $query = "SELECT * FROM registra WHERE id_reg LIKE '%$buscar%' OR ";
               $query .= "nombre LIKE '%$buscar%'OR apellido LIKE '%$buscar%' OR CI LIKE '%$buscar%' OR email LIKE '%$buscar%' OR usuario LIKE '%$buscar%' OR clave LIKE '%$buscar%'"; 
               $model = $table->findBySql($query)->all();
            }else{
            
            $form->getErrors();
            
            }

        }*/

        $form =new FormMostrar;
        $buscar = null;

        if ($form->load(Yii::$app->request->get())) {
            if ($form->validate()) {
                $buscar = Html::encode($form->b);

                $table = Registro::find()
                ->where(["like","id_reg",$buscar])
                ->orwhere(["like", "nombre",$buscar])
                ->orwhere(["like","apellido",$buscar])
                ->orwhere(["like","CI", $buscar]);
                
            $count = clone $table;   

              $pages =new Pagination([

                    "pageSize" => 1,

                    "totalCount" => $count->count()

                ]);

                $model = $table

                        ->offset($pages->offset)

                        ->limit($pages->limit)

                        ->all();

            }else{
                $form->getErrors();
            }


        }else{
            $table = Registro::find();
            $count = clone $table;
           $pages =new Pagination([

                    "pageSize" => 1,

                    "totalCount" => $count->count(),

                ]);

                $model = $table

                        ->offset($pages->offset)

                        ->limit($pages->limit)

                        ->all();
        }

    	return $this->render("mostrar", ["model"=>$model, "form"=>$form, "buscar"=>$buscar, "pages"=>$pages]);

    }

}    