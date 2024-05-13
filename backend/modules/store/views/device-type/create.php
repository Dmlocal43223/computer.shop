<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\DeviceType $model */

$this->title = 'Создать тип устройства';
$this->params['breadcrumbs'][] = ['label' => 'Типы устройств', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
