<?php

namespace app\models\users;

use Yii;
use app\models\posts\PostsRecord;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 *
 * @property Posts[] $posts
 */
class UsersRecord extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', ], 'required'],
            [['email'], 'email'],
            [['username', 'password', 'auth_key'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['auth_key'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(PostsRecord::className(), ['user_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        $return = parent:: beforeSave($insert);

        if ($this->isAttributeChanged('password'))
            $this->password = Yii::$app-> security->generatePasswordHash($this->password);

        if ($this->isNewRecord)
            $this->auth_key = Yii::$app->security->generateRandomKey($length = 255);

        return $return;
    }

    public function getId() //необходимые реализации чтобы работать с сущностью как IdentityInterface
    {
        return $this->id;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByEmail($email)
    {
        return static::findOne($email);
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentityByAccessToken(
        $token,
        $type = null
    ) {
        throw new NotSupportedException('You can only login by email/password pair for now.');
    }

    public static function getOneUserPosts($id)
    {
        $rows = (new \yii\db\Query())
            ->select(['id','title', 'body'])
            ->from('posts')
            ->where('user_id=:id')->addParams([':id' => $id])
            ->all();
        $rows_s=[];
        foreach ($rows as $key)
        {
            $rows_s[intval($key['id'])]=$key;

        }
        //vd($rows);
        return $rows_s;
    }
}