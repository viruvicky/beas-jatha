<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Lhelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patients';
$this->params['breadcrumbs'][] = $this->title;
?><style>

    .form-control {height: 25px; padding: 3px 12px;font-size: 14px; }
    th ,td{max-width: 100px !important;text-align: center;}
</style>
<div class="patient-index table-responsive">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="pull-right">
        <?= Html::a('+ New Patient', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                    return ($data->jathaDeatil)?'<a href='.Yii::$app->urlManager->createUrl(["jatha/view","id"=>$data->jathaDeatil->id]).'>'.$data->jathaDeatil->reg_no.' - '. $data->jathaDeatil->centre.'</a>':'--';

                },
                'filter'=>Lhelper::getActiveJatha(),
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => Yii::t('app','All')],
            ],

            'admitted_date',
            'discharge_date',
            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'text-center'],
                'header'=>'Actions',
                'template' => '{update} {view}',
                'buttons' => [
                    //view button
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'Update'),
                            'class'=>'btn btn-primary',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-search"></span>', $url, [
                            'title' => Yii::t('app', 'View'),
                            'class'=>'btn btn-primary',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
