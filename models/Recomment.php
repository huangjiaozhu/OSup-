<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recomment".
 *
 * @property integer $id
 * @property integer $comment_id
 * @property string $replyer_name
 * @property string $reply_time
 * @property string $reply_content
 */
class Recomment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recomment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['comment_id', 'replyer_name', 'reply_time', 'reply_content'], 'required'],
//            [['comment_id'], 'integer'],
//            [['reply_time'], 'safe'],
//            [['replyer_name', 'reply_content'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment_id' => 'Comment ID',
            'replyer_name' => 'Replyer Name',
            'reply_time' => 'Reply Time',
            'reply_content' => 'Reply Content',
        ];
    }
}
