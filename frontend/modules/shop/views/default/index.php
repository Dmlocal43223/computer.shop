<?php

use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\modules\store\models\search\StoreSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->title = 'Магазин';

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n{pager}",
    'columns' => [
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a(Html::encode($model->serial_number), ['view', 'id' => $model->id]);
            },
        ],
        'price',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{add-to-cart}',
            'buttons' => [
                'add-to-cart' => function ($url, $model, $key) {
                    return Html::a('Добавить в корзину', ['cart/add', 'id' => $model->id], ['class' => 'btn btn-primary']);
                },
            ],
        ],
    ],
]);