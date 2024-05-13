<?php

declare(strict_types=1);

namespace backend\modules\store\models\DTOs;

use yii\base\Model;

final class DeviceDTO extends Model
{
    public ?int $storeId = null;
    public ?int $deviceModelId = null;
    public ?string $serialNumber = null;
    public ?int $manufacturerCountryId = null;

    public function rules(): array
    {
        return [
            [['deviceModelId', 'serialNumber', 'storeId', 'manufacturerCountryId'], 'required'],
            [['deviceModelId', 'storeId', 'manufacturerCountry'], 'integer'],
            [['serialNumber'], 'string'],
        ];
    }

}