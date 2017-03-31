<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attention".
 *
 * @property string $id
 * @property string $userId
 * @property string $attentionedId
 * @property string $attentionTime
 * @property integer $status
 */
class Attention extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attention';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'attentionedId', 'attentionTime', 'status'], 'required'],
            [['userId', 'attentionedId', 'attentionTime', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'attentionedId' => 'Attentioned ID',
            'attentionTime' => 'Attention Time',
            'status' => 'Status',
        ];
    }
}
