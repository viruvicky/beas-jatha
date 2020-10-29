<?php

namespace backend\controllers;

use Yii;
use common\models\Jatha;
use backend\models\JathaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JathaController implements the CRUD actions for Jatha model.
 */
class JathaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Jatha models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JathaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Jatha model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Jatha model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Jatha();
        $model->status = 'quarantine';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->total = $model->male + $model->female;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Sewa Jatha created successfully');
                return $this->redirect(['index']);
            } else  {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Jatha model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->total = $model->male + $model->female;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Sewa Jatha updated successfully');
                return $this->redirect(['index']);
            } else  {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionExport() {

        return \moonland\phpexcel\Excel::export([
            'isMultipleSheet' => false,
            'models' => Jatha::find()->all(),
            'asAttachment' => true,
            'columns' => [
                'reg_no',
                'centre',
                'male',
                'female',
                'total',
                'destination',
                [
                    'attribute'=>'from_date',
                    'value' => function($data){
                        return date('d-M-Y',strtotime($data->from_date));
                    }
                ],
                [
                    'attribute'=>'to_date',
                    'value' => function($data){
                        return date('d-M-Y',strtotime($data->to_date));
                    }
                ],
            ]
        ]);
    }

    /**
     * Deletes an existing Jatha model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Jatha model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jatha the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jatha::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
