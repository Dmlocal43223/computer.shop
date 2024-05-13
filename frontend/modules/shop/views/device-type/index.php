<?php

use common\models\DeviceCategory;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Категории устройств';

$categories = DeviceCategory::find()->all();
?>

<style>
    body {
        background-color: #ebeced;
    }
    .card-link:hover .card {
        box-shadow: 0 0 20px rgba(0,0,0,0.3);
    }
    .card-link {
        text-decoration: none;
        color: inherit;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <?php foreach ($categories as $category): ?>
            <?php /** @var DeviceCategory $category */ ?>
            <div class="col-md-3 mb-4">
                <a href="<?= Url::to(['device-type/index', 'id' => $category->id]) ?>" class="card-link">
                    <div class="card border-0 shadow">
                        <div class="card-header text-center"><?= Html::encode($category->name) ?></div>
                        <div class="card-body" style="height: 200px;">
                            <img src="<?= Html::encode($category->image) ?>" alt="<?= Html::encode($category->name) ?>" class="img-fluid" style="height: 100%;">
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>