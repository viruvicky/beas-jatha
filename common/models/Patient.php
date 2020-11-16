<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "patient".
 *
 * @property int $id
 * @property string $name
 * @property string $f_h_name
 * @property string $age
 * @property int $gender
 * @property int $jatha
 * @property string $admitted_date
 * @property string $discharge_date
 * @property int $status
 */
class Patient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name',  'gender', 'jatha', 'admitted_date', 'status'], 'required'],
            [['gender', 'jatha', 'status'], 'integer'],
            [['admitted_date', 'discharge_date'], 'safe'],
            [['discharge_date'], 'validateDate'],
            [['name', 'f_h_name', 'age'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'f_h_name' => Yii::t('app', 'F/H Name'),
            'age' => Yii::t('app', 'Age'),
            'gender' => Yii::t('app', 'Gender'),
            'jatha' => Yii::t('app', 'Jatha'),
            'admitted_date' => Yii::t('app', 'Admitted Date'),
            'discharge_date' => Yii::t('app', 'Discharge Date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function validateDate($attribute, $params, $validator) {
        if (strtotime($this->discharge_date) < strtotime($this->admitted_date)) {
            $this->addError($attribute, 'To date should be greater then from date');
        }
    }
    public function getCurrentStatus($modelClass = '\common\models\Status')
    {
        return $this->hasOne($modelClass::className(), ['id' => 'status']);
    }
    public function getJathaDeatil($modelClass = '\common\models\Jatha')
    {
        return $this->hasOne($modelClass::className(), ['id' => 'jatha']);
    }
}
