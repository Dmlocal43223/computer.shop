<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\City $model */

$this->title = 'Создать населенный пункт';
$this->params['breadcrumbs'][] = ['label' => 'Населенные пункты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
