<?php

declare(strict_types=1);

namespace backend\modules\store\models\forms;

use yii\base\Model;

final class CreateDeviceForm extends Model
{
    public ?int $deviceModelId = null;
    public ?string $serialNumber = null;
    public ?int $storeId = null;
    public ?int $manufacturerCountryId = null;

    public function rules(): array
    {
        return [
            [['deviceModelId', 'serialNumber', 'storeId', 'manufacturerCountryId'], 'required'],
            [['deviceModelId'], 'integer'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'deviceModelId' => 'Модель',
            'serialNumber' => 'Серийный номер',
            'storeId' => 'Склад',
            'manufacturerCountryId' => 'Страна производитель',
        ];
    }
}