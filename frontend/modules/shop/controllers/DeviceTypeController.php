<?php

declare(strict_types=1);

namespace frontend\modules\shop\controllers;

use frontend\modules\shop\models\search\DeviceTypeSearch;
use yii\web\Controller;

class DeviceTypeController extends Controller
{
    public function actionIndex(): string
    {
        $searchModel = new DeviceTypeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}