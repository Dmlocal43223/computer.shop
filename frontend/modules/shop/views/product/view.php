<?php

/** @var yii\web\View $this */
/** @var common\models\DeviceModel $model */

$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<style>
    body {
        background-color: #ebeced;
    }
    .btn-orange {
        color: #fff;
        background-color: #ff7f00;
        border-color: #ff7f00;
    }

    .btn-orange:hover {
        background-color: #ff6600;
        border-color: #ff6600;
    }
</style>

<h1>Название товара</h1>

<div class="row border shadow rounded" style="display:flex; justify-content:space-between; padding: 20px; margin-bottom: 20px">
    <div class="col-md-5">
        <img src="/uploads/categories/images.jpeg" class="img-fluid" alt="Product Image" style="width: 400px; height: 400px;">
    </div>
    <div class="col-md-7 d-flex flex-column justify-content-between">
        <div class="h-100">
            <p>Описание товара</p>
        </div>
        <div class="h-200">
            <div class="rating">
                <p>Рейтинг</p>
            </div>
        </div>
        <div class="h-100 d-flex justify-content-between align-items-center">
            <div>Цена: $XX.XX</div>
            <div>
                <button type="button" class="btn btn-primary">Добавить в избранное</button>
                <button type="button" class="btn btn-orange" style="width: 150px;">Купить</button>
            </div>
        </div>
    </div>
</div>


<div class="row border shadow rounded" style="padding: 20px; margin-bottom: 20px; display:flex; justify-content:space-between">
    <h2>Характеристики</h2>
</div>

<div class="row border shadow rounded" style="padding: 20px; margin-bottom: 20px; display:flex; justify-content:space-between">
    <h2>Отзывы</h2>
</div>

