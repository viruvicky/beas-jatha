<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\components\Lhelper;
/* @var $this yii\web\View */
/* @var $model common\models\Jatha */

$this->title = $model->reg_no.' - '.$model->centre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jathas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="jatha-view ">


    <h1><?= Html::encode($this->title) ?></h1>

    <p class="pull-right">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class=" col-md-4">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'reg_no',
            'centre',
            'male',
            'female',
            'total',
            'destination',
            'from_date',
            'to_date',
            'created_on',
            'created_by',
        ],
    ]) ?></div>
    <div class=" col-md-8">
        <h4>Deatil of Patient in this Jatha if any</h4>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'name',
                'format' => 'raw',
                'value'=>function ($data) {
                    return $data->name;
                },
                // 'filter'=>false,
            ], [
                'attribute'=>'f_h_name',
                'format' => 'raw',
                'value'=>function ($data) {
                    return $data->f_h_name;
                },
                'filter'=>false,
            ], [
                'attribute'=>'age',
                'format' => 'raw',
                'value'=>function ($data) {
                    return $data->age;
                },
                'filter'=>false,
            ],
            [
                'attribute'=>'status',
                'format' => 'raw',
                'value'=>function ($data) {
                    $class='';
                    if($data->status != 7){$class='red';}
                    return ($data->currentStatus)?'<span class="'.$class.'">'.$data->currentStatus->name.'</span>':'--';
                },
                'filter'=>Lhelper::getStatus(2),
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => Yii::t('app','All')],
            ],
            [
                'attribute'=>'gender',
                'format' => 'raw',
                'value'=>function ($data) {
                    return ($data->gender == 1)?"<span class='label label-primary'>".Yii::t('app','Male')."</span>":"<span class='label label-warning'>".Yii::t('app','Female')."</span>";

                },
                'filter'=>['1' => 'male','2'=>'Female'],
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => Yii::t('app','All')],
            ],
            [
                'attribute'=>'jatha',
                'format' => 'raw',
                'value'=>function ($data) {
                    return ($data->jathaDeatil)?$data->jathaDeatil->reg_no.' - '. $data->jathaDeatil->centre:'--';

                },
                'filter'=>Lhelper::getActiveJatha(),
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => Yii::t('app','All')],
            ],

            'admitted_date',
            'discharge_date',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
</div>
