<?php

use common\helpers\StoreHelper;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Device $model */
/** @var backend\modules\store\models\forms\RemoveDeviceForm $removeDeviceForm */
/** @var array $removeDevices */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="device-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'storeId')->widget(Select2::class, [
        'data' => ArrayHelper::map(StoreHelper::getUserStores(Yii::$app->user->id), 'id', 'name'),
        'options' => [
            'placeholder' => 'Выберите склад',
             'id' => 'store-id',
        ],
    ]); ?>

    <?= $form->field($model, 'serialNumber')->widget(Select2::class, [
        'options' => [
            'id' => 'serialNumbers'
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'ajax' => [
                'url' => Url::to(
                    [
                        '/store/device/get-serial-numbers'
                    ]
                ),
                'data' => new JsExpression('function(params) {
                        return {
                            term: params.term,
                            storeId: $("#store-id").val(),
                        };
                    }'),
            ],
        ],
    ])->label("Серийный номер") ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

