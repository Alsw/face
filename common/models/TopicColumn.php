<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "topic_column".
 *
 * @property string $id
 * @property string $parentId
 * @property string $name
 * @property string $profile
 * @property string $count
 * @property string $admin
 */
class TopicColumn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $children;
    public static function tableName()
    {
        return 'topic_column';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentId', 'name', 'profile', 'count', 'admin'], 'required'],
            [['parentId', 'count'], 'integer'],
            [['profile'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['admin'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parentId' => 'Parent ID',
            'name' => 'Name',
            'profile' => 'Profile',
            'count' => 'Count',
            'admin' => 'Admin',
        ];
    }
    public function findColumn($parentId)
    {   
        $ColumnData = TopicColumn::find()->where(['parentId' => $parentId])->all();
        $data = array();
        foreach ($ColumnData as $key => $value) {
            $data[$value->id] = $value->name;
        }
        return  $data;
    }
    
}
