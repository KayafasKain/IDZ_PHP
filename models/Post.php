<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $overwiew_txt
 * @property string $full_txt
 * @property string $img_link
 * @property string $video_link
 * @property integer $status
 * @property integer $category_id
 * @property integer $user_id
 * @property string $change_date
 *
 * @property Categories $category
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $image;

    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'overwiew_txt', 'full_txt', 'category_id', 'user_id', 'status'], 'required'],
            [['status', 'category_id', 'user_id'], 'integer'],
            [['change_date'], 'safe'],
            [['video_link'], 'match', 'pattern' => '/v=[A-z0-999]*/'],
            [['title', 'overwiew_txt', 'full_txt', 'img_link', 'video_link'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['image'], 'image', 'extensions' => 'png, jpg'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'overwiew_txt' => 'Overwiew Txt',
            'full_txt' => 'Full Txt',
            'img_link' => 'Img Link',
            'video_link' => 'Video Link',
            'status' => 'Status',
            'category_id' => 'Category',
            'user_id' => 'Author',
            'change_date' => 'Change Date',
            'image' => 'Image',
        ];
    }

    public function getStatName()
    {
        $values = array(
            0 => 'Visible',
            1 => 'Hidden'
        );
        if(isset($values[$this->status])) {
            return $values[$this->status];
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    //CreatedAt

                 
}
