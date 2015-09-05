<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Seller */
/* @var $form yii\widgets\ActiveForm */


?>
<div class="seller-form">
    <!-- start upload seller file-->
    <?php if ($model->isNewRecord) { ?>
        <?php $form = ActiveForm::begin([
            'action' => '?r=seller/upload-csv',
            'options' => ['enctype' => 'multipart/form-data'],
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
        ]); ?>
        <div class="form-group">
            <h3 class="col-sm-3 control-label">Upload winner file</h3>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4">
                <?php
                $errors = $model->getFirstErrors();
                if(!empty($errors)) {
                }
                    ?>
            </div>
        </div>
        <?= $form->field($model, 'csv_file')->textInput()->fileInput() ?>

        <div class="form-group">
            <div class="col-sm-offset-4">
                <?=
                Html::submitButton($model->isNewRecord ? 'Upload' : 'Update',
                    [
                        'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                    ])
                ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <hr>
    <?php } ?>
    <!-- end upload winner file-->
    <?php $form = ActiveForm::begin([
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
    ]); ?>
    <div class="form-group">
        <h3 class="col-sm-3 control-label">Create seller group</h3>
    </div>

    <?= $form->field($model, 'sellergroup')->textInput() ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'address')->textInput() ?>

    <?= $form->field($model, 'phoneNo')->textInput() ?>

    <?= $form->field($model, 'percent')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList([0 => "ID Payment", 1 => 'Group Payment']) ?>

    <div class="form-group">
        <div class="col-sm-offset-4">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success ' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
