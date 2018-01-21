<?php

namespace app\models;

use app\models\users\UsersRecord;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    //public $username;
    public $email;
    public $password;
    public $rememberMe;

    /** @var UserRecord */
    public $user;

    private function getUser($email)//username
    {

        if (!$this->user)
            $this->user = $this->fetchUser($email);//username

        return $this->user;
    }
    private function fetchUser($email)//username
    {
        return UsersRecord::findByEmail(compact('email'));
    }

    private function isCorrectHash($plaintext, $hash)
    {
        return Yii::$app->security->validatePassword($plaintext, $hash);
    }

    public function rules()
    {
        return [
            //[['username', 'password'], 'required'],
            [['email', 'password'], 'required'],
            [['email'], 'email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];
    }

    public function validatePassword($attributeName)
    {
        if ($this->hasErrors())
            return;

        $user = $this->getUser($this->email);//username
        if (!($user and $this->isCorrectHash($this->$attributeName, $user->password)))
            $this->addError('password', 'Incorrect username or password.');
    }

    public function login()
    {
        if (!$this->validate())
            return false;
        $user = $this->getUser($this->email);//username
        if (!$user)
            return false;
        return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
    }
}