<?php

namespace app\models;

use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "bill".
 *
 * @property integer $draw_number
 * @property integer $draw_date
 * @property string $bill_number
 * @property integer $win_amount
 * @property integer $id
 */
class Bill extends \yii\db\ActiveRecord
{
    public $csv_file = '';
    public $draw_date_1 = '';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'winning_bills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['draw_number','draw_date_1', 'draw_date', 'bill_number'], 'required'],
            [['draw_number', 'draw_date', 'win_amount'], 'integer'],
            [['bill_number'], 'string', 'max' => 100],
            [['csv_file'], 'file', 'extensions' => 'csv'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'draw_number' => 'Draw Number',
            'draw_date' => 'Draw Date',
            'bill_number' => 'Bill Number',
            'win_amount' => 'Win Amount',
            'id' => 'ID',
            'csv_file' => 'Select file',
        ];
    }

    public function uploadCSV($handleData) {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $row = 1;
            while (($data = fgetcsv($handleData, 1000, ",")) !== FALSE) {
                if($row>1){
                    $model = new Bill();
                    $model->bill_number = $data[0];
                    $model->win_amount = $data[1];
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
