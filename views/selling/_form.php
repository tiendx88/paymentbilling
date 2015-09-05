<?php


use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\bootstrap\ActiveForm;
//use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Selling */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="selling-form">
    <!-- start upload winner file-->
    <?php if ($model->isNewRecord) { ?>
        <?php $form = ActiveForm::begin([
            'action' => '?r=selling/upload-csv',
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
            <h3 class="col-sm-3 control-label">Upload selling file</h3>
        </div>

        <?= $form->field($model, 'draw_number')->textInput() ?>

        <div class="form-group field-selling-draw_date required has-error">
            <label class="control-label col-sm-4" for="bill-draw_date">Draw Date</label>

            <div class="col-sm-8">
                <?=
                DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'draw_date',
                    //'language' => 'ru',
                    'dateFormat' => 'dd-MM-yyyy',
                ]);?>
                <?php if (isset($model->getFirstErrors()['draw_date'])) { ?>
                    <div class="help-block help-block-error ">
                        <?= isset($model->getFirstErrors()['draw_date']) ? $model->getFirstErrors()['draw_date'] : '' ?>
                    </div>
                <?php } ?>
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
        <h3 class="col-sm-3 control-label">Create selling</h3>
    </div>

    <?= $form->field($model, 'draw_number')->textInput() ?>

    <div class="form-group field-bill-draw_date required has-error">
        <label class="control-label col-sm-4" for="bill-draw_date">Draw Date</label>

        <div class="col-sm-8">
            <?=
            DatePicker::widget([
                'model' => $model,
                'attribute' => 'draw_date_1',
                //'language' => 'ru',
                'dateFormat' => 'dd-MM-yyyy',
            ]);?>
            <?php if (isset($model->getFirstErrors()['draw_date_1'])) { ?>
                <div class="help-block help-block-error ">
                    <?= isset($model->getFirstErrors()['draw_date_1']) ? $model->getFirstErrors()['draw_date_1'] : '' ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <?= $form->field($model, 'seller_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <div class="form-group">
        <div class="col-sm-offset-4">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
