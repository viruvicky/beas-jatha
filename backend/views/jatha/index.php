<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\components\Lhelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\JathaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Jathas');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .form-control {height: 25px; padding: 3px 12px;font-size: 14px; }
    th ,td{max-width: 100px !important;text-align: center;}
    </style>
<div class="jatha-index table-responsive"><h5><?= Html::encode($this->title) ?></h5>
    <p class="pull-right">
        <?= Html::a(Yii::t('app', '+ New Jatha'), ['create'], ['class' => 'btn btn-success ']) ?>
        <?= Html::a(Yii::t('app', 'Export Data'), ['export'], ['class' => 'btn btn-warning ']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'summary' => false,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'status',
                'format' => 'raw',
                'value'=>function ($data) {
                    $class='';
                    if($data->status== 2){$class='red';}
                    return ($data->currentStatus)?'<span class="'.$class.'">'.$data->currentStatus->name.'</span>':'--';
                },
                'filter'=>Lhelper::getStatus(1),
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => Yii::t('app','All')],
            ],
            'reg_no',
            'centre',
            'male',
            'female',
            'total',
            [
                'attribute'=>'destination',
                'format' => 'raw',
                'value'=>function ($data) {
                    return ($data->department)?$data->department->name:'--';
                },
                'filter'=>Lhelper::getDepartment(),
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => Yii::t('app','All')],
            ],

            [
                'attribute'=>'from_date',
                'format' => 'raw',
                'value'=>function ($data) {
                    return date('d-m-Y',strtotime($data->from_date));
                },
                //'filter'=>['1'=>Yii::t('app','ON'),'0'=>Yii::t('app','Off')],
            ],[
                'attribute'=>'to_date',
                'format' => 'raw',
                'value'=>function ($data) {
                    return date('d-m-Y',strtotime($data->to_date));
                },
                //'filter'=>['1'=>Yii::t('app','ON'),'0'=>Yii::t('app','Off')],
            ],
            //'created_on',
            //'created_by',

            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'text-center'],
                'header'=>'Actions',
                'template' => ' {patient} {update} {view}',
                'buttons' => [
                    //view button
                    'patient' => function ($url, $model) {
                        if(\common\models\Patient::find()->where('jatha='.$model->id.' AND status != 7')->one()) {
                            return Html::a('<span class="glyphicon glyphicon-user"></span>', ['patient/index', 'jatha' => $model->id], [
                                'title' => Yii::t('app', 'View'),
                                'class' => 'btn btn-warning',
                            ]);
                        }else{
                            return '';
                        }
                    },
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

    <?php Pjax::end(); ?>

</div>
