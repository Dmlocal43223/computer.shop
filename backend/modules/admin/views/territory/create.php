<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Territory $model */

$this->title = 'Создать субъект';
$this->params['breadcrumbs'][] = ['label' => 'Субъекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="territory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
