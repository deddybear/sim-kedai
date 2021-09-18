<?php

namespace Database\Factories;

use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid as Generate;

class IncomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Income::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nominal = 15000;
        $amount = 8;

        return [
            'id' => Generate::uuid4(),
            'created_by' => '4d5756b2-e1a7-4d60-9cb7-bb5bab928a86',
            'updated_by' => '4d5756b2-e1a7-4d60-9cb7-bb5bab928a86',
            'name_product' => 'Cireng',
            'category' => 'Snack',
            'nominal' => $nominal,
            'amount' => $amount,
            'total' => $amount * $nominal,
        ];
    }
}
