<?php

declare(strict_types=1);

namespace common\helpers;

use common\models\Store;

final class StoreHelper
{
    public static function getUserStores(int $userId): array
    {
        return Store::find()
            ->innerJoin(['stores_users', 'stores_users.store_id = store.id'])
            ->andWhere(['stores_users.user_id' => $userId])
            ->all();
    }

    public static function getDecommissioningStore(Store $oldStore): ?Store
    {
        return Store::find()
            ->andWhere(['store.type' => Store::TYPE_DECOMMISSION])
            ->andWhere(['store.territory_id' => $oldStore->territory_id])
            ->one();
    }
}