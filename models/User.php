<?php

namespace app\models;

use yii\base\NotSupportedException;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $password
 *
 * @property Posts $posts
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'unique'],
            [['name', 'password'], 'required'],
            [['name', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'password' => 'Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasOne(Posts::className(), ['id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    
    public static function findByUsername($name)
    {
        return static::findOne(['name' => $name]);
    }
    
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    
    public function getName($id)
    {

        return static::findOne(['id' => $id])->name;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }
    
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    
}
