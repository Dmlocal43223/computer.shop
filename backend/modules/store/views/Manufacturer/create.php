<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Manufacturer $model */

$this->title = 'Create Manufacturer';
$this->params['breadcrumbs'][] = ['label' => 'Manufacturers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
