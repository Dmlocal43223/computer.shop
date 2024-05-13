<?php

use common\models\Country;
use common\models\DeviceModel;
use common\models\Store;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

/** @var yii\web\View $this */
/** @var common\models\Device $model */
/** @var array $devices */
?>

<?php
$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $devices,
    'pagination' => [
        'pageSize' => 10,
    ],
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'storeId',
            'label' => 'Склад',
            'value' => function ($model) {
                return Store::findOne($model->storeId)->name ?? '';
            }
        ],
        [
            'attribute' => 'deviceModelId',
            'label' => 'Модель',
            'value' => function ($model) {
                return DeviceModel::findOne($model->deviceModelId)->name ?? '';
            }
        ],
        [
            'attribute' => 'serialNumber',
            'label' => 'Серийный номер',
        ],
        [
            'attribute' => 'manufacturerCountryId',
            'label' => 'Страна производитель',
            'value' => function ($model) {
                return Country::findOne($model->manufacturerCountryId)->name ?? '';
            }
        ],
        [
            'label' => 'Действия',
            'format' => 'raw',
            'value' => function ($model) {
                $currentUrl = Yii::$app->request->url;
                [$source, $keyList] = (str_contains($currentUrl, 'remove')) ? ['remove', 'removeDevices'] : ['create', 'devices'];
                $url = Url::to(['clear-device', 'serialNumber' => $model['serialNumber'], 'source' => $source, 'keyList' => $keyList]);
                $js = new JsExpression("
            $.ajax({
                url: '{$url}',
                type: 'POST',
                data: {},
                success: function(response) {
                    $('#your-grid-id').yiiGridView('applyFilter');
                }
            });
        ");
                return Html::button('Удалить', ['class' => 'btn btn-danger', 'onclick' => $js]);
            },
        ],
    ],
]);
?>



