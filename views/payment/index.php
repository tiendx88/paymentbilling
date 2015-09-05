<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SellerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Payment';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seller-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        Welcome <?= \app\models\User::findOne([Yii::$app->user->id])->full_name ?>
    </p>

    <p>

    <div class="form-group">
        <div class="col-sm-offset-4">
            <?= Html::a('Create Payment', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    </p>
    <?php
    $form = ActiveForm::begin([
//        'method' => 'post',
        'method' => 'get',
        'action' => ['payment/index'],
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-4',
                'offset' => 'col-sm-offset-4',
                'wrapper' => 'col-sm-8',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]);
    $formId = $form->id;
    ?>
    <div class="col-md-12">
        <div class="form-group field-paymentsearch-draw_number has-success">
            <label class="control-label col-sm-2" for="paymentsearch-draw_number">Draw Number</label>

            <div class="col-sm-2">
                <input type="text" id="paymentsearch-draw_number" class="form-control" name="PaymentSearch[draw_number]"
                       value="" placeholder="draw number">

                <div class="help-block help-block-error "></div>
            </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'sequence',
            'sellergroup',
            'id',
            //'draw_number',
            'name',
            'total',
            [
                'attribute' => 'paid',
                'format' => 'html',
                //'vAlign' => 'middle',
                'value' => function ($model) {
                        /* @var $model \app\models\Selling */
                        return ($model->paid) ? 'paid' : 'not paid';
                    },
            ],
            //'address',
            [
                'attribute' => 'draw_date',
                'format' => 'html',
                //'vAlign' => 'middle',
                'value' => function ($model) {
                        /* @var $model \app\models\Selling */
                        return !empty($model->paid) ? date('d-m-Y', $model->draw_date) : '';
                    },
            ],
            //'phoneNo',
            //'percent',
            //'type',
            [
                'attribute' => 'Bill',
                'format' => 'raw',
                /** @var $model \app\models\SellerSearch */
                'value' => function ($model) {
                        if ($model->paid == 0) {
                            return Html::a(Html::encode("View"), 'index');
                        } else {
                            return Html::a(Html::encode("View"), 'invoice/view');
                        }

                    },
            ]

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
