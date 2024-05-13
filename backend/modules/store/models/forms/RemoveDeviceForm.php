<?php

declare(strict_types=1);

namespace backend\modules\store\models\forms;

use common\models\Device;
use yii\base\Model;

class RemoveDeviceForm extends Model
{
    public ?string $serialNumber = null;
    public ?int $storeId = null;


    public function rules(): array
    {
        return [
            [['serialNumber', 'storeId'], 'required'],
            ['serialNumber', 'validateDeviceExists'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'serialNumber' => 'Серийный номер',
            'storeId' => 'Склад',
        ];
    }

    public function validateDeviceExists($attribute)
    {
        $device = Device::findOne(['serial_number' => $this->serialNumber]);
        if (!$device) {
            $this->addError($attribute, 'Устройство с указанным серийным номером не найдено.');
        }
    }
}