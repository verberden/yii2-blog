<?php

namespace app\models\posts;

use app\models\users\UsersRecord;
use app\models\posts\PostsSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $body
 *
 * @property Users $user
 */
class PostsRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersRecord::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'body' => 'Body',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UsersRecord::className(), ['id' => 'user_id']);
    }


    public function beforeSave($insert)
    {
        $return = parent:: beforeSave($insert);

        if ($this->isNewRecord)
            $this->user_id = Yii::$app->user->getId();

        return $return;
    }
}
