<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Selling */

$this->title = 'Update Selling: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sellings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="selling-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
