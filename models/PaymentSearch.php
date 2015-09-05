<?php

namespace app\models;

use app\helpers\CommonUtils;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;

/**
 * SellingSearch represents the model behind the search form about `app\models\Payment`.
 */
class PaymentSearch extends Payment
{
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $this->load($params);
        $pr = [];
        $sql = 'SELECT COUNT(*) FROM seller s1 left join selling s on s.seller_id=s1.id where 1=1 ';
        $sql2 = 'SELECT s1.*,s.paid,s.draw_number,s.draw_date,s.total FROM seller s1 left join selling s on s.seller_id=s1.id where 1=1 ';
        if($this->id) {
            $pr[':id'] = $this->id;
            $sql .= ' and s1.id=:id';
            $sql2 .= ' and s1.id=:id';
        }
        if(!empty($this->draw_date)) {
            $pr[':draw_date'] = strtotime(date('d-m-Y',$this->draw_date));
            $sql .= ' and s.draw_date=:draw_date';
            $sql2 .= ' and s.draw_date=:draw_date';
        }
        if(!empty($this->total)) {
            $pr[':total'] = $this->total;
            $sql .= ' and s.total=:total';
            $sql2 .= ' and s.total=:total';
        }

        if(!empty($this->paid)) {
            $pr[':paid'] = (int)$this->paid;
            $sql .= ' and s.paid=:paid';
            $sql2 .= ' and s.paid=:paid';
        }

        if(!empty($this->name)) {
            $this->name = CommonUtils::replace_string_injection($this->name);
            $pr[':name'] = "%" . $this->name . "%";
            $sql .= ' and s1.name like :name';
            $sql2 .= ' and s1.name like :name';
        }

        if(!empty($this->sellergroup)) {
            $this->sellergroup = CommonUtils::replace_string_injection($this->sellergroup);
            $pr[':group'] = "%" . $this->sellergroup . "%";
            $sql .= ' and s1.name like :group';
            $sql2 .= ' and s1.name like :group';
        }
        $totalCount = Yii::$app->db->createCommand($sql, $pr)->queryScalar();


        $dataProvider = new SqlDataProvider([
            'sql' => $sql2,
            'params' => $pr,
            'totalCount' => $totalCount,
            //'sort' =>false, to remove the table header sorting
            'sort' => [
                'attributes' => [
                    'id' => [
                        'asc' => ['name' => SORT_ASC],
                        'desc' => ['id' => SORT_DESC],
                        'default' => SORT_DESC,
                        'label' => 'id',
                    ],
                    'name' => [
                        'asc' => ['name' => SORT_ASC],
                        'desc' => ['id' => SORT_DESC],
                        'default' => SORT_DESC,
                        'label' => 'name',
                    ],
                    'created_on'
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        //$this->load($params);
        $items = array();
        foreach($dataProvider->models as $m) {
            $payment = new Payment();
            $payment->setAttributes($m,false);
            array_push($items, $payment);
        }
        unset($dataProvider->models);
        $dataProvider->setModels($items);

        return $dataProvider;
    }
}
