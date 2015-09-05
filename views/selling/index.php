<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SellingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sellings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="selling-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Selling', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'draw_number',
            [
                'attribute' => 'draw_date',
                'format' => 'html',
                //'vAlign' => 'middle',
                'value' => function ($model, $key, $index, $widget) {
                        /* @var $model \app\models\Selling*/
                        return date('d-m-Y', $model->draw_date);
                    },
            ],
            'seller_id',
            'total',
            'draw_number',
            [
                'attribute' => 'paid',
                'format' => 'html',
                //'vAlign' => 'middle',
                'value' => function ($model, $key, $index, $widget) {
                        /* @var $model \app\models\Selling*/
                        return $model->paid ? 'Paid' : 'Not Paid';
                    },
            ],
            // 'paid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
