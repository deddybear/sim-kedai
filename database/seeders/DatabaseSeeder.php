<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Income;
use App\Models\Expenditure;
use App\Models\Stock;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // User::factory(1)->create();
      //  Transaction::factory(1)->create();
      //Income::factory(1)->create();
      //Expenditure::factory(1)->create();
      Stock::factory(1)->create();
    }
}
