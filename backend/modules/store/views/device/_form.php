<?php

use common\helpers\StoreHelper;
use common\models\Country;
use common\models\DeviceModel;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Device $model */
/** @var backend\modules\store\models\forms\CreateDeviceForm $createDeviceForm */
/** @var array $devices */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="device-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'storeId')->widget(Select2::class, [
        'data' => ArrayHelper::map(StoreHelper::getUserStores(Yii::$app->user->id), 'id', 'name'),
        'options' => [
            'placeholder' => 'Выберите склад'
        ],
    ]); ?>

    <?= $form->field($model, 'deviceModelId')->widget(Select2::class, [
        'data' => ArrayHelper::map(DeviceModel::find()->all(), 'id', 'name'),
        'options' => [
            'placeholder' => 'Выберите модель'
        ],
    ]); ?>

    <?= $form->field($model, 'serialNumber')->textInput() ?>

    <?= $form->field($model, 'manufacturerCountryId')->widget(Select2::class, [
        'data' => ArrayHelper::map(Country::find()->all(), 'id', 'name'),
        'options' => [
            'placeholder' => 'Выберите страну'
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
