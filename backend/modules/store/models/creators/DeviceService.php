<?php

declare(strict_types=1);

namespace backend\modules\store\models\creators;

use backend\modules\store\models\DTOs\DeviceDTO;
use common\helpers\StoreHelper;
use common\models\Device;
use yii\db\Exception;

class DeviceService
{
    public static function create(DeviceDTO $deviceDto): Device
    {
        $device = new Device();
        $device->device_model_id = $deviceDto->deviceModelId;
        $device->serial_number = $deviceDto->serialNumber;
        $device->status = Device::STATUS_STORE;
        $device->store_id = $deviceDto->storeId;
        $device->manufacturer_country_id = $deviceDto->manufacturerCountryId;
        $device->price = 0;

        if (!$device->save()) {
            throw new Exception("Ошибка сохранения устройства. " . implode('', $device->getErrorSummary(true)));
        }

        return $device;
    }

    public static function delete(DeviceDTO $deviceDto): bool
    {
        $device = Device::findOne(['serial_number' => $deviceDto->serialNumber]);

        if (!$device) {
            throw new Exception('Устройство с указанным серийным номером не найдено.');
        }

        $device->status = Device::STATUS_DELETED;

        $store = StoreHelper::getDecommissioningStore($device->store);

        if (!$store) {
            throw new Exception("Склад списания для устройства {$deviceDto->serialNumber} не найден");
        }

        $device->store_id = $store->id;

        if (!$device->save()) {
            throw new Exception("Ошибка сохранения устройства. " . implode('', $device->getErrorSummary(true)));
        }

        return true;
    }
}