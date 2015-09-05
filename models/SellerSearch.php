<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Seller;

/**
 * SellerSearch represents the model behind the search form about `app\models\Seller`.
 */
class SellerSearch extends Seller
{
    public $paid = 0;
    public $draw_date = '';
    public $draw_number = 0;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'percent','draw_number','paid', 'type'], 'integer'],
            [['draw_date'], 'string'],
            [['sellergroup', 'name', 'phoneNo'], 'safe'],
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
        $query = Seller::find();

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
            'percent' => $this->percent,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'sellergroup', $this->sellergroup])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phoneNo', $this->phoneNo]);

        return $dataProvider;
    }
}
