<?php

namespace app\controllers;

use app\models\Bill;
use app\models\Selling;
use app\models\User;
use Yii;
use app\models\Seller;
use app\models\SellerSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SellerController implements the CRUD actions for Seller model.
 */
class SellerController extends Controller
{
    const _TYPE_SELLER = 'seller';
    const _TYPE_BILL = 'bill';
    const _TYPE_SELLING = 'selling';

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
     * Lists all Seller models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SellerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Seller model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$sellergroup)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $sellergroup),
        ]);
    }

    /**
     * Creates a new Seller model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $role = isset(Yii::$app->user->identity->role) ? Yii::$app->user->identity->role : 0;
        if($role != User::ROLE_ADMIN) {
            return $this->redirect(['index']);
        }
        $seller = new Seller();
        if ($seller->load(Yii::$app->request->post()) && $seller->save()) {
            return $this->redirect(['view', 'id' => $seller->id]);
        } else {
            return $this->render('create', [
                'model' => $seller,
            ]);
        }
    }

    public function actionUploadCsv() {
        $role = isset(Yii::$app->user->identity->role) ? Yii::$app->user->identity->role : 0;
        if($role != User::ROLE_ADMIN) {
            return $this->redirect(['index']);
        }
        $seller = new Seller();
        if ($seller->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($seller, 'csv_file');
            try{
                $handle = fopen("$file->tempName", "r");
                if($seller->uploadCSV($handle)) {
                    return $this->redirect(['index']);
                } else {
                    return $this->render('create', [
                        'model' => $seller,
                    ]);
                }
            }catch(Exception $error){
            }
        } else {
            return $this->render('create', [
                'model' => $seller,
            ]);
        }

    }
    /**
     * Updates an existing Seller model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $sellergroup
     * @return mixed
     */
    public function actionUpdate($id, $sellergroup)
    {
        $model = $this->findModel($id, $sellergroup);
        if ($model !== null) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id,'sellergroup'=>$model->sellergroup]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }


    }

    /**
     * Deletes an existing Seller model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$sellergroup)
    {
        $this->findModel($id,$sellergroup)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Seller model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Seller the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id,$sellergroup)
    {
        if (($model = Seller::findOne(['id'=>$id,'sellergroup'=>$sellergroup])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
