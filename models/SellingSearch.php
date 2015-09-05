<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Selling;

/**
 * SellingSearch represents the model behind the search form about `app\models\Selling`.
 */
class SellingSearch extends Selling
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'draw_number', 'draw_date', 'total', 'paid'], 'integer'],
            [['seller_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Selling::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'draw_number' => $this->draw_number,
            'draw_date' => $this->draw_date,
            'total' => $this->total,
            'paid' => $this->paid,
        ]);

        $query->andFilterWhere(['like', 'seller_id', $this->seller_id]);

        return $dataProvider;
    }
}
