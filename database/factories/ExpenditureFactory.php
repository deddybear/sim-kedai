<?php

namespace Database\Factories;

use App\Models\Expenditure;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid as Generate;

class ExpenditureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expenditure::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nominal = 6000;
        $amount = 7;
        $unit = 'Pcs';
        return [
            'id' => Generate::uuid4(),
            'created_by' => '4d5756b2-e1a7-4d60-9cb7-bb5bab928a86',
            'updated_by' => '4d5756b2-e1a7-4d60-9cb7-bb5bab928a86',
            'name_product' => 'Cireng',
            'category' => 'Bahan Baku',
            'nominal' => $nominal,
            'amount' => $amount,
            'total' => $amount * $nominal,
            'unit' => $unit
        ];
    }
}
