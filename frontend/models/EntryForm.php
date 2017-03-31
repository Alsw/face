<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
class EntryForm extends Model
{
    /**
     * @inheritdoc
     */
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }
}
