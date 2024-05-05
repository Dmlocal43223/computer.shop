<?php

declare(strict_types=1);

namespace backend\modules\store\models\forms;

use yii\base\Model;

final class CreateDeviceForm extends Model
{
    public ?int $deviceTypeId = null;
    public ?int $deviceModelId = null;

    public function rules(): array
    {
        return [
            [['deviceModelId'], 'required'],
            [['deviceModelId'], 'integer'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'deviceTypeId' => 'Тип',
            'deviceModelId' => 'Модель',
        ];
    }
}