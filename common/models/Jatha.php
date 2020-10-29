<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "jatha".
 *
 * @property int $id
 * @property int $reg_no
 * @property string $centre
 * @property int $male
 * @property int $female
 * @property int $total
 * @property string $destination
 * @property string $from_date
 * @property string $to_date
 * @property string $status
 * @property string $created_on
 * @property int $created_by
 */
class Jatha extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jatha';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_no', 'centre', 'male', 'female', 'destination', 'from_date', 'to_date'], 'required'],
            [['reg_no'], 'unique'],
            [['centre', 'destination'], 'string'],
            [['to_date'], 'validateDate'],
            [['reg_no', 'male', 'female', 'total', 'created_by'], 'integer'],
            [['from_date', 'to_date', 'created_on'], 'safe'],
            [['centre', 'destination', 'status'], 'string', 'max' => 225],
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_on',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => false,
            ],
        ];
    }

    public function validateDate($attribute, $params, $validator) {
        if (strtotime($this->to_date) < strtotime($this->from_date)) {
            $this->addError($attribute, 'To date should be greater then from date');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reg_no' => 'Reg No',
            'centre' => 'Centre / Jatha',
            'male' => 'Male',
            'female' => 'Female',
            'total' => 'Total',
            'destination' => 'Destination',
            'from_date' => 'From',
            'to_date' => 'To',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
        ];
    }
}
