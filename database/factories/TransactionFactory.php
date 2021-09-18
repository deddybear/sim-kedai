<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid as Generate;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        // return [
        //     'id' => Generate::uuid4(),
        //     'created_by' => '4d5756b2-e1a7-4d60-9cb7-bb5bab928a86',
        //     'updated_by' => '4d5756b2-e1a7-4d60-9cb7-bb5bab928a86',
        //     'name_product' => 'Coffe latte',
        //     'category' => 'Signature',
        //     'nominal' => 18500,
        //     'amount' => 21,
        //     'total' => 18500 * 21,
        //     'type_transaction' => 1
        // ];

        return [
            'id' => Generate::uuid4(),
            'created_by' => '4d5756b2-e1a7-4d60-9cb7-bb5bab928a86',
            'updated_by' => '4d5756b2-e1a7-4d60-9cb7-bb5bab928a86',
            'name_product' => 'Taro ice milk',
            'category' => 'Blended Cream',
            'nominal' => 22000,
            'amount' => 30,
            'total' => 22000 * 30,
            'type_transaction' => 1
        ];
    }

}
