<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Department', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
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
