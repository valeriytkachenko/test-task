<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    protected $user;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            ['username', 'string'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email'],
        ];
    }
   
    /**
    * Sings up a user using the provided username, mail and password.
    * @return User|null
    */
    public function signup()
    {
       if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = $user->setPassword($this->password);
        return $user->save() ? $user : null;
    }

    /**
    * Logs in a user using the provided username and password.
    * @return bool whether the user is logged in successfully
    */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser());
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    
    public function getUser()
    {
        return User::findOne(['username' => $this->username]);
    }

}
