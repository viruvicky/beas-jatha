<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Status */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="status-form col-md-6">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'position')->dropDownList(['1' => 'Jatha','2'=>'Patient']) ?>
    <?= $form->field($model, 'is_active')->checkbox() ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
