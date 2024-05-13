<?php

declare(strict_types=1);

namespace frontend\modules\shop\controllers;

use backend\modules\store\models\search\DeviceModelSearch;
use common\models\DeviceModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProductController extends Controller
{
    public function actionIndex(): string
    {
        $searchModel = new DeviceModelSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id): ?DeviceModel
    {
        if (($model = DeviceModel::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}