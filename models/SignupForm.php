<?php
/**
 * Created by PhpStorm.
 * User: sergei
 * Date: 23.01.18
 * Time: 10:44
 */


namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Security;

class SignupForm extends Model
{
    public $name;
    public $phone;
    public $email;
    /**
     * Здесь мы указываем правила валидации - они могут быть как стандартными, так и кастомными
     */
    public function rules()
    {
        return [
            ['name', 'required'],
//[['phone','email'], 'safe'],
            [['email'], 'email'],
            [['phone', 'email'], 'validatePhoneEmailEmpty', 'skipOnEmpty'=> false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'email' => 'Email',
            'phone' => 'Телефон',
        ];
    }

    /* Кастомная функция для проверки, что хотя бы одно из полей email или phone посетитель заполнил */
    public function validatePhoneEmailEmpty()
    {
        if(empty($this->phone) && empty($this->email))
        {
            $errorMsg= 'Укажите ваш email или телефон';
            $this->addError('phone',$errorMsg);
            $this->addError('email',$errorMsg);
        }
        if(!empty($this->phone) && (strlen($this->phone)<7))
        {
            $errorMsg= 'Слишком мало цифр в номере телефона';
            $this->addError('phone',$errorMsg);
        }
    }

    /**
     * Аналог ContactForm
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom(['youremail@adress.ru' => $this->name])
                ->setSubject('Заявка на занятия по брейку от '.$this->name)
                ->setTextBody($this->email."\n Телефон: ".$this->phone)
                ->send();

            return true;
        } else {
            return false;
        }
    }
}