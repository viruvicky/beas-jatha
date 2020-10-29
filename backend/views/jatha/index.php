<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\JathaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Jathas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jatha-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Jatha'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Export Data'), ['export'], ['class' => 'btn btn-warning pull-right']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'reg_no',
            'centre',
            'male',
            'female',
            'total',
            'destination',
            'from_date',
            'to_date',
            //'created_on',
            //'created_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}  | {delete}'
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
