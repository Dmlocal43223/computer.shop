<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Device $model */
/** @var array $devices */

$this->title = 'Создать устройство';
$this->params['breadcrumbs'][] = ['label' => 'Устройства', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'devices' => $devices,
    ]) ?>

</div>
