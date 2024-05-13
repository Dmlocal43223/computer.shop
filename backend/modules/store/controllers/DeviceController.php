<?php

namespace backend\modules\store\controllers;

use backend\modules\store\models\creators\DeviceService;
use backend\modules\store\models\DTOs\DeviceDTO;
use backend\modules\store\models\forms\CreateDeviceForm;
use backend\modules\store\models\forms\RemoveDeviceForm;
use common\helpers\SessionHelper;
use common\models\Device;
use backend\modules\store\models\search\DeviceSearch;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * DeviceController implements the CRUD actions for Device model.
 */
class DeviceController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Device models.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new DeviceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Device model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Device model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate(): Response|string
    {
        $createDeviceForm = new CreateDeviceForm;

        if ($createDeviceForm->load(Yii::$app->request->post()) && $createDeviceForm->validate()) {
            $deviceDto = new DeviceDTO;
            $deviceDto->setAttributes($createDeviceForm->attributes);
            SessionHelper::addItemInSession('devices', $deviceDto->serialNumber, $deviceDto);
            $createDeviceForm = new CreateDeviceForm;
        }

        $devices = Yii::$app->session->get('devices', []);

        return $this->render('create', [
            'model' => $createDeviceForm,
            'devices' => $devices,
        ]);
    }

    public function actionCreateDevices(): Response
    {
        $deviceDTOs = Yii::$app->session->get('devices', []);

        if (!$deviceDTOs) {
            Yii::$app->session->setFlash('error', 'Список устройств пуст');
        }

        $createdDevicesId = [];
        /** @var DeviceDTO $deviceDTO */
        foreach ($deviceDTOs as $deviceDTO) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $createdDevicesId[] = DeviceService::create($deviceDTO)->id;
                SessionHelper::removeItemFromSession('devices', $deviceDTO->serialNumber);
                $transaction->commit();
            } catch (\Throwable $exception) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }

        if ($createdDevicesId) {
            Yii::$app->session->setFlash('success', "Созданные устройства: " . implode(', ', $createdDevicesId));
        }

        return $this->redirect(['create']);
    }

    /**
     * Updates an existing Device model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id): Response|string
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionClearDevices(string $source, string $keyList): Response
    {
        Yii::$app->session->remove($keyList);
        Yii::$app->session->setFlash('success', 'Список устройств очищен');

        if ($source == 'remove') {
            return $this->redirect(['remove']);
        } else {
            return $this->redirect(['create']);
        }
    }

    public function actionClearDevice(string $serialNumber, string $source, string $keyList): Response
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            SessionHelper::removeItemFromSession($keyList, $serialNumber);
            Yii::$app->session->setFlash('success', 'Устройство успешно удалено из списка.');
        } catch (\Throwable $exception) {
            Yii::$app->session->setFlash('error', 'Устройство с указанным идентификатором не найдено.');
        }

        if ($source == 'remove') {
            return $this->redirect(['remove']);
        } else {
            return $this->redirect(['create']);
        }
    }

    public function actionRemove(): Response|string
    {
        $removeDeviceForm = new RemoveDeviceForm;

        if ($removeDeviceForm->load(Yii::$app->request->post()) && $removeDeviceForm->validate()) {
            $deviceDto = new DeviceDTO;
            $deviceDto->setAttributes($removeDeviceForm->attributes);;

            SessionHelper::addItemInSession('removeDevices', $removeDeviceForm->serialNumber, $deviceDto);
            $removeDeviceForm = new RemoveDeviceForm;
        }

        $removeDevices = Yii::$app->session->get('removeDevices', []);

        return $this->render('remove', [
            'model' => $removeDeviceForm,
            'removeDevices' => $removeDevices,
        ]);
    }

    public function actionRemoveDevices(): Response
    {
        $deviceDTOs = Yii::$app->session->get('removeDevices', []);

        if (!$deviceDTOs) {
            Yii::$app->session->setFlash('error', 'Список устройств пуст');
        }

        $removeDevicesId = [];
        /** @var DeviceDTO $deviceDTO */
        foreach ($deviceDTOs as $deviceDTO) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                DeviceService::delete($deviceDTO);
                SessionHelper::removeItemFromSession('removeDevices', $deviceDTO->serialNumber);
                $removeDevicesId[] = $deviceDTO->serialNumber;
                $transaction->commit();
            } catch (\Throwable $exception) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }

        if ($removeDevicesId) {
            Yii::$app->session->setFlash('success', "Списанные устройства: " . implode(', ', $removeDevicesId));
        }

        return $this->redirect(['remove']);
    }

    /**
     * Deletes an existing Device model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Device model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Device the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Device
    {
        if (($model = Device::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetSerialNumbers(int $storeId): array
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $serialNumbers = Device::find()->andWhere(['store_id' => $storeId])->select(['device.serial_number as id', 'device.serial_number as text'])->asArray()->all();

        return ['results' => $serialNumbers];
    }
}
