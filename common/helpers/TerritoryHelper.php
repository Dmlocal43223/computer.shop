<?php

declare(strict_types=1);

namespace common\helpers;
use common\models\Territory;

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
}