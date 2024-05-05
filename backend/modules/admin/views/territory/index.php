<?php

use common\helpers\TerritoryHelper;
use common\models\Territory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\modules\admin\models\search\TerritorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Субъекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="territory-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать субъект', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            [
                'attribute' => 'district',
                'value' => function ($model) {
                    return TerritoryHelper::getTerritoryName($model->district);
                },
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Territory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
