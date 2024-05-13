<?php

declare(strict_types=1);

namespace common\helpers;

use Yii;
use yii\db\Exception;

final class SessionHelper
{
    public static function removeItemFromSession(string $key, string $findItem): bool
    {
        $items = Yii::$app->session->get($key, []);

        if (isset($items[$findItem])) {
            unset($items[$findItem]);
            Yii::$app->session->set($key, $items);
        } else {
            throw new Exception("Элемент {$findItem} не найден");
        }

        return true;
    }

    public static function addItemInSession(string $key, string $keyItem, mixed $item): bool
    {
        $items = Yii::$app->session->get($key, []);
        $items[$keyItem] = $item;
        Yii::$app->session->set($key, $items);

        return true;
    }
}