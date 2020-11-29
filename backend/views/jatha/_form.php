<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\Lhelper;
/* @var $this yii\web\View */
/* @var $model common\models\Jatha */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jatha-form">

    <?php $form = ActiveForm::begin(['options' => ['autocomplete' => 'off']]); ?>
        <div class="row">
            <div class="col-md-3">
               <?= $form->field($model, 'reg_no')->textInput(['autocomplete'=>false]) ?>
               <?= $form->field($model, 'centre')->textInput(['maxlength' => true]) ?>
               <?= $form->field($model, 'male')->textInput() ?>
               <?= $form->field($model, 'female')->textInput() ?>
            </div>
        <div class="col-md-3">
            <?php $langData= Lhelper::getDepartment(); ?>
            <?= $form->field($model, 'destination')->dropDownList($langData , ['prompt' => Yii::t('app','Select Destination')]) ?>
            <?php $langData= Lhelper::getStatus(1); ?>
           <?= $form->field($model, 'status')->dropDownList($langData , ['prompt' => Yii::t('app','Select Status')]) ?>

                <div class="form-group field-project-end_date ">
                    <label class="control-label" for="project-end_date"><?=Yii::t('app','From')?></label>
                    <div class="input-group">
                        <?php  echo yii\jui\DatePicker::widget([
                            'model' => $model,
                            'attribute' => 'from_date',
                            'dateFormat' => 'yyyy-MM-dd',
                            'options' => ['autocomplete'=>'off'],
                        ]); ?>
                        <div class="help-block"></div></div>
                </div>


                <div class="form-group field-project-end_date ">
                    <label class="control-label" for="project-end_date"><?=Yii::t('app','To')?></label>
                    <div class="input-group">
                        <?php  echo yii\jui\DatePicker::widget([
                            'model' => $model,
                            'attribute' => 'to_date',
                            'dateFormat' => 'yyyy-MM-dd',
                            'options' => ['autocomplete'=>'off'],
                        ]); ?>
                        <div class="help-block"></div></div>


            <?php
           /* echo $form->field($model, 'to_date')->widget(\kartik\date\DatePicker::classname(), [
                'options' => ['placeholder' => 'Select date ...','readonly'=>true],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd/mm/yyyy'
                ]
            ]);*/
            ?></div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
