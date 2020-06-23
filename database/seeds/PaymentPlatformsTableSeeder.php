<?php

use Illuminate\Database\Seeder;
use App\PaymentPlatform;

class PaymentPlatformsTableSeeder extends Seeder
{

    public function run()
    {
        PaymentPlatform::create([
            'name' => 'mercadopago',
            'image' => 'assets/img/mercadopago.jpg'
        ]);
    }
}
