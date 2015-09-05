<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\Selling;
use app\models\SellingSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SellingController implements the CRUD actions for Selling model.
 */
class SellingController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Selling models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SellingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Selling model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Selling model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Selling();

        if ($model->load(Yii::$app->request->post())) {
            $model->draw_date = strtotime(date('d-m-Y',strtotime($model->draw_date_1)));
            if(!$model->save()) {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUploadCsv() {
        $role = isset(Yii::$app->user->identity->role) ? Yii::$app->user->identity->role : 0;
        if($role != User::ROLE_ADMIN) {
            return $this->redirect(['index']);
        }
        $model = new Selling();
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'csv_file');
            try{
                if(!empty($file)) {
                    $handle = fopen("$file->tempName", "r");
                    if($model->uploadCSV($handle)) {
                        return $this->redirect(['index']);
                    } else {
                        empty($model->draw_date) ? $model->addError('draw_date','Draw date cannot be blank.') : '';
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }
                }
                empty($model->draw_date) ? $model->addError('draw_date','Draw date cannot be blank.') : '';
                $model->addError('csv_file','File CSV cannot be blank.');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }catch(Exception $error){
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing Selling model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Selling model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Selling model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Selling the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Selling::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
