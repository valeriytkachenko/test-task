<?php

namespace app\modules\admin;

use yii\filters\AccessControl;
use Yii;
use app\modules\admin\models\Login;
/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';
/*
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['basic.superadmin', 'basic.admin'],
                    ]
                ],
            ],
        ];
    }
*/
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->layout = 'main';
    }
}
