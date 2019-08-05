<?php
namespace app\models;
use yii\base\Model;

class RegisterForm extends Model{

   public $username;
   public $password;
   public $confirmPassword;

   public function rules() {
     return [
      [['username', 'password', 'confirmPassword'], 'required', 'message' => 'Заполните поле'],
      ['username', 'unique', 'targetClass' => User::class,  'message' => 'Этот логин уже занят'],
      ['confirmPassword', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают" ],
     ];
   }

   public function attributeLabels() {
     return [
       'username' => 'Логин',
       'password' => 'Пароль',
       'confirmPassword' => 'Подтвердите пароль'
     ];
   }

}
 ?>
