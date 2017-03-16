<?php
namespace app\models;

use yii\base\Model;
use Yii;

class AuthForm extends Model
{
    public $username;
    public $password;
    public $email;
    private $_user;

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 8],

        ];
    }
    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        $user=$this->getUser();
        if($user && $user->validatePassword($this->password)){
           return Yii::$app->user->login($this->getUser(),  3600 * 24 * 30 );
        }else{
            $this->addError('username','Incorrect username or password.');
            $this->addError('password','Incorrect username or password.');
            return false;
        }
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if(!$user->validate()){
            $this->addErrors($user->errors);
            return false;
        }else {
            return $user->save() ? $this->login() : false;
        }
    }
    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }
}