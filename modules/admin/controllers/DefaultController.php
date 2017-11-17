<?php

namespace app\modules\admin\controllers;
use yii\web\Controller;
use app\modules\admin\models\Login;
use Yii;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{   
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->admin->isGuest)
        {
            $this->redirect(['login']);
            
        }
    
        return $this->render('index');
        
    }
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {   
        if(Yii::$app->admin->isGuest)
        {
            $this->layout = 'main-login';
            $model = new Login();
            
            if(Yii::$app->request->post('Login'))
            {
                $model->attributes=Yii::$app->request->post('Login');
                
                if($model->validate())
                {
                    Yii::$app->admin->login($model->getAdmin());
                    $this->redirect(['index']);
                }
            }
            return $this->render('login', [
                'model' => $model,
            ]);
        }
        else
        {
            $this->redirect(['index']);
        }
    }
     /**
     * Logouts user and redirect him to the login page
     */
    public function actionLogout()
    {
        if(!Yii::$app->admin->isGuest)
        {
            Yii::$app->admin->logout();
            $this->redirect(['login']);      
        }
        else{
            $this->redirect(['login']);
        }
    }
}
