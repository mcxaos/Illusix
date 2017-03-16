<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class MainController extends Controller
{
    protected $identity;
    public function init()
    {

        $this->identity = Yii::$app->user->identity;
        parent::init(); // Call parent implementation;
      
    }

    public function render($view, $params = [])
    {
        if( Yii::$app->controller->id !='auth' && $this->identity == null){
           $this->redirect('/auth',302);
        }
        $this->view->params['identity'] = $this->identity;
        return parent::render($view,$params);
    }
}
