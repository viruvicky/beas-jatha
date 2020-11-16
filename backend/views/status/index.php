<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Statuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Status', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute'=>'position',
                'format' => 'raw',
                'value'=>function ($data) {
                    return ($data->position == 1)?"<span class='label label-primary'>".Yii::t('app','Jatha')."</span>":"<span class='label label-warning'>".Yii::t('app','Patient')."</span>";

                },
                'filter'=>['1' => 'Jatha','2'=>'Patient'],
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => Yii::t('app','All')],
            ],[
                'attribute'=>'is_active',
                'format' => 'raw',
                'value'=>function ($data) {
                    return ($data->is_active == 1)?"<span class='label label-primary'>".Yii::t('app','ON')."</span>":"<span class='label label-warning'>".Yii::t('app','Off')."</span>";

                },
                'filter'=>['1'=>Yii::t('app','ON'),'0'=>Yii::t('app','Off')],
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => Yii::t('app','All')],
            ],

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
