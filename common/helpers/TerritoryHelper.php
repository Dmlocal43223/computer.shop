<?php

declare(strict_types=1);

namespace common\helpers;
use common\models\City;
use common\models\Territory;
use InvalidArgumentException;
use yii\db\Exception;

final class TerritoryHelper
{
    public const TERRITORY_MAPPER = [
        Territory::CENTRAL => 'Центральный',
        Territory::SOUTHERN => 'Южный',
        Territory::NORTHWESTERN => 'Северо-Западный',
        Territory::FAR_EASTERN => 'Дальневосточный',
        Territory::SIBERIAN => 'Сибирский',
        Territory::URAL => 'Уральский',
        Territory::VOLGA => 'Приволжский',
        Territory::NORTH_CAUCASIAN => 'Северо-Кавказский'
    ];

    public static function getTerritoryName(string $territory): string
    {
        return self::TERRITORY_MAPPER[$territory] ?? $territory;
    }

    public static function getTerritoryByCityId(?int $cityId): Territory
    {
        if (!$cityId) {
            throw new InvalidArgumentException('Необходимо передать cityId');
        }

        $city = City::findOne($cityId);

        if (!$city) {
            throw new Exception('Город не найден');
        }

        return $city->territory;
    }
}