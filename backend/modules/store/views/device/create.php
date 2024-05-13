<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Device $model */
/** @var array $devices */

$this->title = 'Оприходовать устройства';
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

<div class="device-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="device-create-form">
        <?= $this->render('_form', [
            'model' => $model,
            'devices' => $devices,
        ]) ?>
    </div>

    <div class="device-list" style="<?= empty(Yii::$app->session->get('devices', [])) ? 'display: none;' : 'display: block;'; ?>">
        <?= $this->render('_device-list.php', [
            'model' => $model,
            'devices' => $devices,
        ]) ?>

        <?= Html::a('Оприходовать', ['create-devices'], ['class' => 'btn btn-success']) ?>
        <span style="margin-right: 5px;"></span>
        <?= Html::a('Очистить', ['clear-devices', 'source' => 'create', 'keyList' => 'devices'], ['class' => 'btn btn-danger']) ?>
    </div>
</div>
<!--<script>-->
<!--    function clearDevice(deviceId) {-->
<!--        $.ajax({-->
<!--            url: '/store/device/clear-device',-->
<!--            type: 'POST',-->
<!--            data: {deviceId: deviceId},-->
<!--            success: function(response) {-->
<!--                alert('Устройство успешно удалено');-->
<!--            },-->
<!--            error: function(xhr, status, error) {-->
<!--                console.error(xhr.responseText);-->
<!--                alert('Произошла ошибка при удалении устройства');-->
<!--            }-->
<!--        });-->
<!--    }-->
<!--</script>-->
