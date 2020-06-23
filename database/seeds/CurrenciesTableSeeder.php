<?php

use Illuminate\Database\Seeder;
use App\Currency;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $curriencies = [
            'usd',
            'ars'
        ];

        foreach ($curriencies as $currency) {
            Currency::create([
                'iso' => $currency
            ]);
        }

    }
}
