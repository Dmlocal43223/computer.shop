<?php

use common\models\DeviceType;
use common\models\Manufacturer;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\DeviceModel $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="device-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'device_type_id')->widget(Select2::class, [
        'data' => ArrayHelper::map(DeviceType::find()->all(), 'id', 'name'),
        'options' => [
            'placeholder' => 'Выберите тип устройства'
        ],
    ]); ?>

    <?= $form->field($model, 'guarantee')->textInput() ?>

    <?= $form->field($model, 'manufacturer_id')->widget(Select2::class, [
        'data' => ArrayHelper::map(Manufacturer::find()->all(), 'id', 'name'),
        'options' => [
            'placeholder' => 'Выберите производителя'
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
