<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 9/2/15
 * Time: 5:19 PM
 */

namespace app\controllers;


use app\models\PaymentSearch;
use app\models\SellerSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;

class PaymentController extends Controller {
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
        $searchModel = new PaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate() {
        return $this->render('create', []);
    }
} 