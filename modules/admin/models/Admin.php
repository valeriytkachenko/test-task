<?php

namespace app\modules\admin\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Admin extends ActiveRecord implements IdentityInterface
{
    /**
    * Validates password
    *
    * @param string $password password to validate
    * @return bool if password provided is valid for current user
    */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
    
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public function getId(){
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null){}

    public function getAuthKey(){}

    public function validateAuthKey($authKey){}
}