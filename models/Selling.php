<?php

namespace app\models;

use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "selling".
 *
 * @property integer $id
 * @property integer $draw_number
 * @property integer $draw_date
 * @property string $seller_id
 * @property integer $total
 * @property integer $paid
 */
class Selling extends \yii\db\ActiveRecord
{
    const _PAID = 10;
    public $csv_file = '';
    public $draw_date_1 = '';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'selling';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['draw_number','draw_date_1', 'draw_date', 'seller_id'], 'required'],
            [['draw_number', 'draw_date', 'total', 'paid'], 'integer'],
            [['seller_id'], 'string', 'max' => 255],
            [['csv_file'], 'file', 'extensions' => 'csv'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'draw_number' => 'Draw Number',
            'draw_date' => 'Draw Date',
            'seller_id' => 'Sell ID',
            'total' => 'Total',
            'paid' => 'Paid',
            'csv_file' => 'Select file',
        ];
    }

    public function uploadCSV($handleData) {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $row = 1;
            while (($data = fgetcsv($handleData, 1000, ",")) !== FALSE) {
                if($row>1){
                    $model = new Selling();
                    $model->seller_id = $data[0];
                    $model->total = $data[1];
                    $model->paid = 0;
                    $model->draw_number = $this->draw_number;
                    $model->draw_date = strtotime(date('d-m-Y',strtotime($this->draw_date)));
                    $model->draw_date_1 = $this->draw_date;
                    if(!$model->validate() || !$model->save()) {
                        $transaction->rollBack();
                        return false;
                    }
                }
                $row++;
            }
            $transaction->commit();
            return true;
        } catch (Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }
}
