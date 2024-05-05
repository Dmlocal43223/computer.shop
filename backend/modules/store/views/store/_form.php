<?php

use common\models\City;
use common\models\Territory;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Store $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="store-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'common' => 'Common', 'shop' => 'Shop', 'service' => 'Service', ], ['prompt' => '']) ?>

    <?php if (!$model->isNewRecord): ?>
        <?= $form->field($model, 'is_deleted')->checkbox() ?>
    <?php endif; ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'territory_id')->widget(Select2::class, [
        'data' => ArrayHelper::map(Territory::find()->all(), 'id', 'name'),
        'options' => [
            'placeholder' => 'Выбрать территорию'
        ],
    ]); ?>

    <?= $form->field($model, 'city_id')->widget(Select2::class, [
        'data' => ArrayHelper::map(City::find()->all(), 'id', 'name'),
        'options' => [
            'placeholder' => 'Выбрать город'
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
