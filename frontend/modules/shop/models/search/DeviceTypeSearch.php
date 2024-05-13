<?php

declare(strict_types=1);

namespace frontend\modules\shop\models\search;

use common\models\DeviceType;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class DeviceTypeSearch extends DeviceType
{
    public function rules(): array
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['name'], 'string'],
            [['name', 'category_id', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = DeviceType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}