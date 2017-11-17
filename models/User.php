<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{   
 
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){}

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey(){}

    public function validateAuthKey($authKey){}

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
    /**
    * Hash password
    *
    * @param string $password password to hash
    * @return string hashed password
    */
    public function setPassword($password)
    {
        return md5($password);
    }
}
