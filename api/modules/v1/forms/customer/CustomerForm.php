<?php
/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 28.04.2021
 * Time: 15:18
 */

namespace api\modules\v1\forms\customer;


use common\models\customer\Customer;
use common\models\customer\CustomerHasSpace;
use yii\base\Model;

class CustomerForm extends Model
{
    public $name;
    public $telephone;
    public $status_id;


    public function rules()
    {
        return [
            [['telephone', 'status_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public static function get($space)
    {
        return Customer::find()
            ->select([
                'customer.id',
                'customer.name',
                'customer.telephone',
                'customer_has_space.rating',
                'type_customer.name as status',
                'type_customer.id as status_id',
            ])
            ->leftJoin(
                'customer_has_space',
                'customer_has_space.customer_id = customer.id AND customer_has_space.space_id = ' . $space
            )
            ->leftJoin(
                'type_customer',
                'customer_has_space.type_customer_id = type_customer.id'
            )
            ->asArray()
            ->all();
    }

    public static function one($id, $space)
    {
        return Customer::find()
            ->select([
                'customer.id',
                'customer.name',
                'customer.telephone',
                'type_customer.name as status',
                'type_customer.id as status_id',
            ])
            ->leftJoin(
                'customer_has_space',
                'customer_has_space.customer_id = customer.id AND customer_has_space.space_id = ' . $space
            )
            ->leftJoin(
                'type_customer',
                'customer_has_space.type_customer_id = type_customer.id'
            )
            ->where([
                'customer.id' => $id
            ])
            ->asArray()
            ->one();
    }

    public function update($id, $space)
    {
        $customer = Customer::findOne($id);
        $customer->name = $this->name;
        $customer->telephone = $this->telephone;

        $customerHasSpace = CustomerHasSpace::find()->where(['customer_id' => $id, 'space_id' => $space])->one();
        $customerHasSpace->type_customer_id = $this->status_id;

        if($customer->save() && $customerHasSpace->save()){
            return true;
        }
        return false;
    }

    public function delete($id)
    {
    }
}