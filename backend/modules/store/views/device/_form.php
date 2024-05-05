<?php

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

<!--    --><?php //= $form->field($model, 'price')->textInput() ?>

<!--    --><?php //= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deviceModelId')->textInput() ?>
    <?php foreach ($devices as $device) {
            echo implode(',', $device);
    } ?>

<!--    --><?php //= $form->field($model, 'manufacturer_country')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
