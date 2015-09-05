<?php

namespace app\models;

use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "seller".
 *
 * @property string $sellergroup
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phoneNo
 * @property integer $percent
 * @property integer $type
 */
class Seller extends \yii\db\ActiveRecord
{
    public $csv_file = '';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seller';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['sellergroup', 'id', 'name'], 'required'],
            [['id', 'percent', 'type'], 'integer'],
            [['sellergroup', 'name'], 'string', 'max' => 100],
            [['address', 'phoneNo'], 'string', 'max' => 20],
            [['csv_file'], 'file', 'extensions' => 'csv'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sellergroup' => 'Sellergroup',
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'phoneNo' => 'Phone No',
            'percent' => 'Percent',
            'type' => 'Type',
            'csv_file' => 'Select file',
        ];
    }

    public function uploadCSV($handleData) {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $row = 1;
            while (($data = fgetcsv($handleData, 1000, ",")) !== FALSE) {
                if($row>1){
                    $model = new Seller();
                    $model->sellergroup = $data[0];
                    $model->id = $data[1];
                    $model->name = $data[2];
                    $model->address = $data[3];
                    $model->phoneNo = $data[4];
                    $model->percent = $data[5];
                    $model->type = $data[6];
                    if(!$model->validate() || !$model->save()) {
                        $transaction->rollBack();
                        //var_dump($model->getFirstErrors());exit;
                        return false;
                    }
                }
                $row++;
            }
            $transaction->commit();
            return true;
        } catch (Exception $e) {
            $msg = $row > 1 ? 'ID Seller in group existed or ID Personal existed.' . 'Check file csv line '. $row
                : 'ID Seller in group existed or ID Personal existed.';
            $this->addError('csv_file', $msg);
            $transaction->rollBack();
            return false;
        }
    }
}
