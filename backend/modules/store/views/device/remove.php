<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Device $model */
/** @var array $removeDevices */

$this->title = 'Списать устройства';
$this->params['breadcrumbs'][] = ['label' => 'Устройства', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .device-create-form {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
</style>

<div class="device-remove">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="device-create-form">
        <?= $this->render('_remove-form', [
            'model' => $model,
            'removeDevices' => $removeDevices,
        ]) ?>
    </div>

    <div class="device-list" style="<?= empty(Yii::$app->session->get('removeDevices', [])) ? 'display: none;' : 'display: block;'; ?>">
        <?= $this->render('_device-list.php', [
            'model' => $model,
            'devices' => $removeDevices,
        ]) ?>

        <?= Html::a('Списать', ['remove-devices'], ['class' => 'btn btn-success']) ?>
        <span style="margin-right: 5px;"></span>
        <?= Html::a('Очистить', ['clear-devices', 'source' => 'remove', 'keyList' => 'removeDevices'], ['class' => 'btn btn-danger']) ?>
    </div>
</div>