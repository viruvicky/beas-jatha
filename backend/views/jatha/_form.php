<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Jatha */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jatha-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'reg_no')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'centre')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'male')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'female')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'destination')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?php
            echo $form->field($model, 'from_date')->widget(\kartik\date\DatePicker::classname(), [
                'options' => ['placeholder' => "Select date ...",'readonly'=>true],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy/mm/dd'
                ]
            ]);
            ?>
        </div>
        <div class="col-md-4">
            <?php
            echo $form->field($model, 'to_date')->widget(\kartik\date\DatePicker::classname(), [
                'options' => ['placeholder' => 'Select date ...','readonly'=>true],
                'pluginOptions' => [
                    'autoclose'=>true,
                     'format' => 'yyyy/mm/dd'
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
