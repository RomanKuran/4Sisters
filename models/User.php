<?php

namespace app\models;


use \yii\db\ActiveRecord;
use \yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 *
 * @property Blog[] $blogs
 */
class User extends ActiveRecord implements IdentityInterface {

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            // [['username', 'password'], 'required'],
            [['authKey', 'accessToken'], 'default', 'value' => ''],
            [['password', 'authKey', 'accessToken'], 'string'],
            [['username'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'username'      => 'Логин',
            'password'      => 'Пароль',
            'authKey'       => 'Auth Key',
            'accessToken'   => 'Access Token',
        ];
    }

    public static function findIdentity($id)
    {
        var_dump(static::findOne($id));
        exit;
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findByUsername($username)
    {
        $user = self::find()->where('username = :username', [':username' => $username])->one();
        if (is_object($user) && isset($user->username) && strlen($user->username) > 1) {
            return new static($user);
        }

        return null;
    }

    public function validatePassword($password)
    {
        return $this->cryptPassword($password) === $this->password;
    }

    private function cryptPassword($password)
    {
        return md5($password);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blog::class, ['id_user' => 'id']);
    }

}
