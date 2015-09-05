<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BillSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bills';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bill', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'draw_number',
            [
                'attribute' => 'draw_date',
                'format' => 'html',
//                'vAlign' => 'middle',
                'value' => function ($model, $key, $index, $widget) {
                         /* @var $model \app\models\Bill*/
                        return date('d-m-Y', $model->draw_date);
                    },
            ],
            'bill_number',
            'win_amount',
            //'id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
