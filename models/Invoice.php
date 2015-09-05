<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property integer $id
 * @property string $to
 * @property string $address
 * @property string $phoneNo
 * @property string $group
 * @property integer $draw_number
 * @property integer $draw_date
 * @property double $total_selling
 * @property integer $discount_type
 * @property double $discount_amount
 * @property double $payment_amount
 * @property double $late_payment_fee
 * @property integer $deadline
 * @property double $price_commission
 * @property double $total_payment
 * @property double $bill_numbers
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['to', 'group', 'draw_number', 'draw_date', 'deadline'], 'required'],
            [['to', 'address', 'phoneNo', 'group','bill_numbers'], 'string'],
            [['draw_number', 'draw_date', 'discount_type', 'deadline'], 'integer'],
            [['total_selling', 'discount_amount', 'payment_amount', 'late_payment_fee', 'price_commission', 'total_payment'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'to' => 'To',
            'address' => 'Address',
            'phoneNo' => 'Phone No',
            'group' => 'Group',
            'draw_number' => 'Draw Number',
            'draw_date' => 'Draw Date',
            'total_selling' => 'Total Selling',
            'discount_type' => 'Discount Type',
            'discount_amount' => 'Discount Amount',
            'payment_amount' => 'Payment Amount',
            'late_payment_fee' => 'Late Payment Fee',
            'deadline' => 'Deadline',
            'price_commission' => 'Price Commission',
            'total_payment' => 'Total Payment',
        ];
    }
}
