<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\Lhelper;
/* @var $this yii\web\View */
/* @var $model common\models\Patient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'f_h_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'age')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'gender')->radioList(['1'=>'Male','2'=>'Female']) ?>

    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'jatha')->dropDownList(Lhelper::getActiveJatha(), ['prompt' => Yii::t('app','Select Jatha')]) ?>
        <?php /*
        echo $form->field($model, 'admitted_date')->widget(\kartik\date\DatePicker::classname(), [
            'options' => ['placeholder' => "Select date ...",'readonly'=>true],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd/mm/yyyy'
            ]
        ]);
        */?><!--
        --><?php
/*        echo $form->field($model, 'discharge_date')->widget(\kartik\date\DatePicker::classname(), [
            'options' => ['placeholder' => "Select date ...",'readonly'=>true],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd/mm/yyyy'
            ]
        ]);*/
        ?>
        <div class="form-group field-project-end_date ">
            <label class="control-label" for="project-end_date"><?=Yii::t('app','Admitted date')?></label>
            <div class="input-group">
                <?php  echo yii\jui\DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'admitted_date',
                    'dateFormat' => 'yyyy-MM-dd',
                    'options' => ['autocomplete'=>'off'],
                ]); ?>
                <div class="help-block"></div></div>
        </div>
        <div class="form-group field-project-end_date ">
            <label class="control-label" for="project-end_date"><?=Yii::t('app','Discharge date')?></label>
            <div class="input-group">
                <?php  echo yii\jui\DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'discharge_date',
                    'dateFormat' => 'yyyy-MM-dd',
                    'options' => ['autocomplete'=>'off'],
                ]); ?>
                <div class="help-block"></div></div>
        </div>

        <?php $langData= Lhelper::getStatus(2); ?>
        <?= $form->field($model, 'status')->dropDownList($langData , ['prompt' => Yii::t('app','Select Status')]) ?>

        <div class="form-group ">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
