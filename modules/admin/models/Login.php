<?php

namespace app\modules\admin\models;


use Yii;
use yii\base\Model;

/**
 * Login is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Login extends Model
{
    public $email;
    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            ['email', 'email'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {   
        //if no errors
        if(!$this->hasErrors())
        {
            //getting user for password validation
            $admin = $this->getAdmin();
            
            if(!$admin || !$admin->validatePassword($this->password))
            {
                //if user wasn't match or password is wrong
                $this->addError($attribute, 'Wrong email or password!');
            }
        }
        
    }
    public function getAdmin()
    {
        return Admin::findOne(['email' => $this->email]);
    }
}
