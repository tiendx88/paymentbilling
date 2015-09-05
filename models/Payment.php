<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 9/2/15
 * Time: 6:12 PM
 */

namespace app\models;


use yii\base\Model;

class Payment extends Model
{
    public $sellergroup = '';
    public $id = '';
    public $name = '';
    public $address = '';
    public $phoneNo = '';
    public $percent = '';
    public $type = '';
    public $draw_number = '';
    public $draw_date = '';
    public $seller_id = '';
    public $total = '';
    public $paid = '';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'percent', 'type'], 'integer'],
            [['sellergroup', 'name'], 'string', 'max' => 100],
            [['address', 'phoneNo'], 'string', 'max' => 20],
            [['draw_number', 'draw_date', 'total', 'paid'], 'integer'],
            [['seller_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sellergroup' => 'Group',
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'phoneNo' => 'Phone Number',
            'percent' => 'Percent',
            'type' => 'Type',
            'draw_number' => 'Draw Number',
            'draw_date' => 'Date',
            'seller_id' => 'Sell ID',
            'total' => 'Total Selling',
            'paid' => 'Pay status',
        ];
    }

}